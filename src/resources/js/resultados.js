const pathArray = window.location.pathname.split('/');
const votacaoId = pathArray[pathArray.length - 1];

async function getSufragios(perPage = 1000) {
    let url = `/api/sufragios?perPage=${perPage}`;
    return fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function getSufragio(id) {
    let url = `/api/sufragios/${id}`;
    return fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function getRelatorio(id) {
    let spinnerShow = (id) => {
        document.getElementById(id).style.display = 'inline-block';
    };

    let spinnerStop = (id) => {
        document.getElementById(id).style.display = 'none';
    };

    spinnerShow(`spinner-relatorio-${id}`);

    let url = `/api/sufragios/relatorio/${id}`;
    return fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/download',
            'Content-Type': 'application/download'
        },
        redirect: 'follow'
    })
        .then((response) => { return response.blob(); })
        .then((data) => {
            var a = document.createElement("a");
            a.href = window.URL.createObjectURL(data);
            a.download = "relatorio";
            a.click();
            spinnerStop(`spinner-relatorio-${id}`);
        })
        .catch(error => {
            console.error(error);
        });
};

$(document).ready(async () => {
    window.RESULTADO = new bootstrap.Modal(document.getElementById('modal-resultado'));

    let voltar = document.getElementById('voltar');
    voltar.addEventListener('click', () => {
        window.RESULTADO.hide();
    });

    let response = await getSufragios();
    let sufragios = await response.json();

    $('#votacoes').DataTable({
        data: sufragios.data,
        language: {
            url: "/lib/pt_br.json"
        },
        columns: [
            { title: 'ID', data: 'id', class: 'foo' },
            { title: 'Nome', data: 'nome' },
            { title: 'Início', data: '@inicio' },
            { title: 'Fim', data: '@fim' },
            {
                title: 'Status',
                data: null,
                render: (data, type, row) => {
                    let agora = new Date();
                    let inicio = new Date(data.inicio.replace(" ", "T") + "-03:00");
                    let fim = new Date(data.fim.replace(" ", "T") + "-03:00");

                    if (fim <= agora) {
                        return `
                            <button class="btn btn-primary relatorio-btn" data-id="${data.id}">
                                <span id="spinner-relatorio-${data.id}" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                Relatório
                            </button>
                            <button id="btn${data.id}" class="btn btn-primary resultado-btn" data-votacao-id="${data.id}">Resultado</button>
                        `;
                    }
                    if (inicio > agora) {
                        return '<button class="disabled btn btn-primary" disabled>Não iniciada</button>';
                    }

                    return '<button class="finalizada disabled btn btn-primary" disabled>Em andamento</button>';
                }
            }
        ],
        drawCallback: function () {
            // Adiciona os eventos de clique aos botões de relatório
            $('.relatorio-btn').on('click', function () {
                let id = $(this).data('id');
                getRelatorio(id);
            });

            // Adiciona os eventos de clique aos botões de resultado
            $('.resultado-btn').on('click', function () {
                let votacaoId = $(this).data('votacao-id');
                openResult({ dataset: { votacaoId: votacaoId } });
            });
        }
    });
});

async function openResult(element) {
    let resultado = await getResult(element.dataset.votacaoId);
    let votacao = document.querySelector('#votacao');
    votacao.innerHTML = '';
    let nome = document.querySelector('#votacao-nome');
    nome.textContent = resultado.nome;
    let questoes = resultado.questoes;

    questoes.forEach(element => {
        let questao = document.createElement('div');
        questao.setAttribute('id', `questao-${element.id}`);
        questao.classList.add('grid', 'justify-center');
        votacao.append(questao);

        let respostas = element.respostas;
        let data = [['pergunta', 'votos']];
        respostas.forEach((value) => {
            let tmp = [value.label, value.votos];
            data = data.concat([tmp]);
        });

        let options = {
            title: element.label,
            is3D: true,
            enableInteractivity: true,
            pieSliceText: 'value',
            legend: {
                maxLines: 5,
                position: 'labeled',
                textStyle: { fontSize: 10 }
            },
            tooltip: {
                text: 'both',
                isHtml: true,
                trigger: 'selection'
            },
            chartArea: {
                top: '20%',
            },
        };
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(() => { drawChart(data, options, `questao-${element.id}`); });
    });

    window.RESULTADO.show();
};

async function getResult(id) {
    let response = await getSufragio(id);
    return await response.json();
}

function drawChart(data, options, element) {
    var data = google.visualization.arrayToDataTable(data);
    var chart = new google.visualization.PieChart(document.getElementById(element));
    chart.draw(data, options);
}

function removeAll(id) {
    const div = document.getElementById(id);
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
}
