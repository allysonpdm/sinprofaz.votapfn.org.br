const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

async function getSufragios(perPage = 1000){
    let url = `/api/sufragios?perPage=${perPage}`;
    return fetch(`${url}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {return response;})
    .catch(error => {
        console.error(error);
    });
};

async function getRelatorio(id){
    let spinnerShow = (id) =>{
        document.getElementById(id).style.display = 'inline-block';
    };

    let spinnerStop=(id)=>{
        document.getElementById(id).style.display = 'none';
    };
    spinnerShow(`spinner-relatorio-${id}`)
    let url = `/api/sufragios/relatorio/${id}`;
    return fetch(`${url}`, {
        method: 'GEt',
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
    let response  = await getSufragios();
    let sufragios = await response.json();
    $('#votacoes').DataTable( {
        data: sufragios.data,
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Nova votação',
                className: 'btn-primary',
                action: function ( e, dt, node, config ) {
                    window.location=`/admin/votacao`
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                 }
            }
        ],
        language: {
            url:"/lib/pt_br.json"
        },
        columns: [
            { title: 'ID', data: 'id', class: 'foo'},
            { title: 'Nome', data: 'nome' },
            { title: 'Início', data: '@inicio' },
            { title: 'Fim', data: '@fim' },
            {
                title: 'Status',
                data: null, render: ( data, type, row ) => {
                    let agora = new Date();
                    let inicio = new Date(data.inicio.replace(" ", "T") + "-03:00");
                    let fim = new Date(data.fim.replace(" ", "T") + "-03:00");
                    if(fim <= agora ){
                        return `
                        <button class="btn btn-success" onClick="window.location='/votacao/${data.id}';">Ir</button>
                        <button class="disabled btn btn-primary" disabled>Editar</button>
                        `;
                    }

                    return `
                        <button class="btn btn-success" onClick="window.location='/votacao/${data.id}';">Ir</button>
                        <button class="btn btn-primary" onClick="window.location='/admin/votacao/${data.id}';">Editar</button>
                    `;
                }
            }
        ]
    });
});
