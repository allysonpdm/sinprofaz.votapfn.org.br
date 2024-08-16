var NOME;
var QUESTAO_LABEL;
var RESPOSTA_LABEL;

async function getRespostas(questaoId) {
    let url = `/api/respostas`;
    if (questaoId != null && questaoId != undefined && questaoId != '') {
        return fetch(`${url}?wheres[0][column]=questaoId&wheres[0][condition]==&wheres[0][search]=${questaoId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => { return response.json(); })
            .catch(error => {
                console.error(error);
            });
    }
};

async function getArquivos(sufragioId) {
    let url = `/api/arquivos`;
    if (sufragioId != null && sufragioId != undefined && sufragioId != '') {
        return fetch(`${url}?wheres[0][column]=sufragioId&wheres[0][condition]==&wheres[0][search]=${sufragioId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => { return response.json(); })
            .catch(error => {
                console.error(error);
            });
    }
};

async function getQuestoes(sufragioId) {
    let url = `/api/questoes`;
    if (sufragioId != null && sufragioId != undefined && sufragioId != '') {
        return fetch(`${url}?wheres[0][column]=sufragioId&wheres[0][condition]==&wheres[0][search]=${sufragioId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => { return response.json(); })
            .catch(error => {
                console.error(error);
            });
    }
};

async function sendSufragio() {
    let id = document.getElementById('sufragioId').value
    let url = id == '' ? `/api/sufragios` : `/api/sufragios/${id}`;
    let method = id == '' ? 'POST' : 'PUT';
    return fetch(`${url}`, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getFieldsVotacao())
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

let getFieldsVotacao = () => {

    let obj = {
        id: document.getElementById('sufragioId').value,
        subtitulo: document.getElementById('subtitulo').value,
        descricao: document.getElementById('descricao').value,
        inicio: document.getElementById('inicio').value.replace('T', ' '),
        fim: document.getElementById('fim').value.replace('T', ' '),
    };
    if (NOME != document.getElementById('nome').value) {
        obj['nome'] = document.getElementById('nome').value;
    }
    return obj;
};

async function sendQuestao() {
    let id = document.getElementById('questaoId').value;
    let url = id == '' ? `/api/questoes` : `/api/questoes/${id}`;
    let method = id == '' ? 'POST' : 'PUT';
    return fetch(`${url}`, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getFieldsQuestao())
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function deleteSufragio() {
    let id = document.getElementById('sufragioId').value;
    let url = `/api/sufragios/${id}`;
    return fetch(`${url}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            force: true
        })
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function deleteQuestao() {
    let id = document.getElementById('questaoId').value;
    let url = `/api/questoes/${id}`;
    return fetch(`${url}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            force: true
        })
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function deleteResposta() {
    let id = document.getElementById('respostaId').value;
    let url = `/api/respostas/${id}`;
    return fetch(`${url}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            force: true
        })
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

let getFieldsQuestao = () => {

    let obj = {
        id: document.getElementById('questaoId').value,
        sufragioId: document.getElementById('sufragioId').value,
        label: document.getElementById('label').value,
        complemento: document.getElementById('complemento').value,
        limiteEscolhas: document.getElementById('limiteEscolhas').value,
    };
    if (
        QUESTAO_LABEL != document.getElementById('label').value
    ) {
        obj['label'] = document.getElementById('label').value;
    }
    return obj;
};


let getFieldsResposta = () => {

    let obj = {
        questaoId: document.getElementById('questaoId').value,
        label: document.getElementById('label').value,
    };
    if (
        RESPOSTA_LABEL != document.getElementById('label').value
    ) {
        obj['label'] = document.getElementById('label').value;
    }
    return obj;
};

async function sendArquivo() {
    let form = new FormData();
    let arquivo = document.getElementById('file').files[0];
    form.append("file", arquivo);
    form.append("label", document.getElementById('label').value);
    form.append("sufragioId", document.getElementById('sufragioId').value);
    let url = `/api/arquivos`;
    return fetch(`${url}`, {
        method: 'POST',
        body: form
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function deleteArquivo(id) {
    let url = `/api/arquivos/${id}`;
    return fetch(`${url}`, {
        method: 'DELETE',
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

async function sendResposta() {
    let id = document.getElementById('respostaId').value;
    let url = id == '' ? `/api/respostas` : `/api/respostas/${id}`;
    let method = id == '' ? 'POST' : 'PUT';
    return fetch(`${url}`, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(getFieldsResposta())
    })
        .then(response => { return response; })
        .catch(error => {
            console.error(error);
        });
};

let setErrors = (erros) => {
    Object.entries(erros).forEach(([key, mensagem]) => {
        document.querySelector(`[data-erro="${key}"]`).innerHTML = mensagem;
    });
};

let spinnerShow = (id) => {
    document.getElementById(id).style.display = 'inline-block';
};

let spinnerStop = (id) => {
    document.getElementById(id).style.display = 'none';
};

let createAlertDialog = (type, message) => {
    let target = document.querySelector('.card-body');
    let alert = document.createElement('div');
    let strong = document.createElement('strong');
    let button = document.createElement('button');
    alert.id = 'alert-erros';
    alert.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show');
    alert.setAttribute('role', 'alert');
    strong.textContent = message;
    button.classList.add('btn-close');
    button.setAttribute('data-bs-dismiss', 'alert');
    button.setAttribute('aria-label', 'Close');

    alert.append(strong, button);
    target.insertBefore(alert, target.firstChild);
}

let createVotacao = async () => {
    spinnerShow('spinner-salvar');
    let response = await sendSufragio();
    spinnerStop('spinner-salvar');
    let json = await response.json();
    switch (response.status) {
        case 200:
        case 201:
            window.location = `/admin/votacao/${json.id}/arquivos`;
            break;
        case 422:
            setErrors(json.errors);
            break;
        default:
            createAlertDialog('danger', json.message);
            break;
    }
};

let createArquivo = async () => {
    spinnerShow('spinner-salvar');
    let response = await sendArquivo();
    spinnerStop('spinner-salvar');
    let json = await response.json();
    switch (response.status) {
        case 201:
            window.location = `/admin/votacao/${json.sufragioId}/arquivos`;
            break;
        case 422:
            setErrors(json.errors);
            break;
        default:
            createAlertDialog('danger', json.message);
            break;
    }
};

let removerArquivo = async (id) => {
    spinnerShow(`spinner-delete-${id}`);
    let sufragioId = document.getElementById('sufragioId').value;
    let response = await deleteArquivo(id);
    spinnerStop(`spinner-delete-${id}`);
    let json = await response.json();
    switch (response.status) {
        case 200:
            window.location = `/admin/votacao/${sufragioId}/arquivos`;
            break;
        case 422:
            setErrors(json.errors);
            break;
        default:
            createAlertDialog('danger', json.message);
            break;
    }
};

let createQuestao = async () => {
    spinnerShow('spinner-salvar');
    let response = await sendQuestao();
    spinnerStop('spinner-salvar');
    let json = await response.json();
    switch (response.status) {
        case 200:
        case 201:
            window.location = `/admin/votacao/${json.sufragioId}/questoes/${json.id}`;
            break;
        case 422:
            setErrors(json.errors);
            break;
        default:
            createAlertDialog('danger', json.message);
            break;
    }
};

let createResposta = async () => {
    spinnerShow('spinner-salvar');
    let response = await sendResposta();
    spinnerStop('spinner-salvar');
    let json = await response.json();
    switch (response.status) {
        case 200:
        case 201:
            window.location = `/admin/votacao/${json.questao.sufragioId}/questoes/${json.questao.id}/respostas/${json.id}`;
            break;
        case 422:
            setErrors(json.errors);
            break;
        default:
            createAlertDialog('danger', json.message);
            break;
    }
};

let listarArquivos = async () => {
    let sufragioId = document.getElementById('sufragioId')?.value;

    if (sufragioId != null && sufragioId != undefined && sufragioId != '') {
        let arquivos = await getArquivos(sufragioId);

        $('#list-arquivos').DataTable({
            data: arquivos.data,
            language: {
                url: "/lib/pt_br.json"
            },
            columns: [
                { title: 'ID', data: 'id' },
                { title: 'Label', data: 'label' },
                { title: 'Filename', data: 'filename' },
                { title: 'Size (Kb)', data: 'size' },
                { title: 'MimeType', data: 'mimeType' },
                {
                    title: 'Ações',
                    data: null,
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                        <button class="btn btn-danger col-6" onclick="removerArquivo(${data.id})">
                            <span id="spinner-delete-${data.id}" class="spinner-border spinner-border-sm"style="display:none;"></span>
                            Excluir
                        </button>
                        `;
                    }
                },
            ]
        });
    }
};

let listarQuestoes = async () => {
    let sufragioId = document.getElementById('sufragioId')?.value;

    if (sufragioId != null && sufragioId != undefined && sufragioId != '') {
        let questoes = await getQuestoes(sufragioId);

        $('#list-questoes').DataTable({
            data: questoes.data,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Nova Questão',
                    className: 'btn-primary',
                    action: function (e, dt, node, config) {
                        window.location = `/admin/votacao/${sufragioId}/questoes`
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary')
                    }
                }
            ],
            language: {
                url: "/lib/pt_br.json"
            },
            columns: [
                { title: 'ID', data: 'id' },
                { title: 'Label', data: 'label' },
                { title: 'Complemento', data: 'complemento' },
                { title: 'Limite de escolhas', data: 'limiteEscolhas' },
                {
                    title: 'Ações',
                    data: null,
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                        <a class="btn btn-primary col-6" href="/admin/votacao/${data?.sufragioId}/questoes/${data?.id}">Editar</a>
                        <a class="btn btn-primary col-6" href="/admin/votacao/${data?.sufragioId}/questoes/${data?.id}/respostas">Respostas</a>
                        `;
                    }
                },
            ]
        });
    }
};

let listarRespostas = async () => {
    let sufragioId = document.getElementById('sufragioId')?.value;

    if (sufragioId != null && sufragioId != undefined && sufragioId != '') {
        let questaoId = document.getElementById('questaoId')?.value;
        let respostas = await getRespostas(questaoId);

        $('#list-respostas').DataTable({
            data: respostas.data,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Nova resposta',
                    className: 'btn-primary',
                    action: function (e, dt, node, config) {
                        window.location = `/admin/votacao/${sufragioId}/questoes/${questaoId}/respostas`
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary')
                    }
                }
            ],
            language: {
                url: "/lib/pt_br.json"
            },
            columns: [
                { title: 'ID', data: 'id' },
                { title: 'Label', data: 'label' },
                {
                    title: 'Acoes',
                    data: null,
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                        <a class="btn btn-primary col-12" href="/admin/votacao/${data?.questao.sufragioId}/questoes/${data?.questao.id}/respostas/${data?.id}">Editar</a>
                        `;
                    }
                },
            ]
        });
    }
};

document.addEventListener("DOMContentLoaded", function (e) {
    NOME = document.getElementById('nome')?.value;
    QUESTAO_LABEL = RESPOSTA_LABEL = document.getElementById('label')?.value;

    listarQuestoes();
    listarArquivos();
    listarRespostas();

    document.getElementById("salvar-votacao")?.addEventListener("click", async (e) => {
        createVotacao();
    });

    document.getElementById("salvar-arquivo")?.addEventListener("click", async (e) => {
        createArquivo();
    });

    document.getElementById("salvar-questao")?.addEventListener("click", async (e) => {
        createQuestao();
    });

    document.getElementById("salvar-resposta")?.addEventListener("click", async (e) => {
        createResposta();
    });

    document.getElementById("excluir-votacao")?.addEventListener("click", async (e) => {
        spinnerShow('spinner-excluir');
        let response = await deleteSufragio();
        spinnerStop('spinner-excluir');
        if (response.status == 200) {
            window.location = `/gerenciador/`;
        }
    });

    document.getElementById("excluir-questao")?.addEventListener("click", async (e) => {
        spinnerShow('spinner-excluir');
        let sufragioId = document.getElementById('sufragioId').value;
        let response = await deleteQuestao();
        spinnerStop('spinner-excluir');
        if (response.status == 200) {
            window.location = `/admin/votacao/${sufragioId}/questoes`;
        }
    });

    document.getElementById("excluir-resposta")?.addEventListener("click", async (e) => {
        spinnerShow('spinner-excluir');
        let sufragioId = document.getElementById('sufragioId').value;
        let questaoId = document.getElementById('questaoId').value;
        let response = await deleteResposta();
        spinnerStop('spinner-excluir');
        if (response.status == 200) {
            window.location = `/admin/votacao/${sufragioId}/questoes/${questaoId}/respostas`;
        }
    });
});
