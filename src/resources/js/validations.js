const pathArray = window.location.pathname.split('/');
const votacaoId = pathArray[pathArray.length - 1];

function onlyNumberKey(event) {
    event = (event) ? event : window.event;
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
};

async function sendSufragio(){
    let url = `/api/sufragios/votar`;
    return fetch(`${url}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: votar()
    })
    .then(response => {return response;})
    .catch(error => {
        console.error(error);
    });
};

async function getSufragio(){
    let url = `/api/sufragios/${votacaoId}`;
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

let getAssociado = async() =>{
    let url = '/api/associados';
    data = {
        "sufragioId": votacaoId,
        "cpf": getCpf().value
    };

    return fetch(`${url}?` + new URLSearchParams(data), {
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

let entrar = async () =>{
    spinnerShow('spinner-entrar');
    let response = await getAssociado();
    if(response.status != 200){
        response = await response.json();
        setErrors(response.errors)
    }else{
        hiddenAssociadosBox();
        setAssociado(await response.json());
        showVotacao();
    }
    spinnerStop('spinner-entrar');
};

let setAssociado = (associado)=>{
    window.ASSOCIADO = associado;
    let target = document.getElementById('associado');
    let nome = document.createElement('p');
    let cpf = document.createElement('p');
    let status = document.createElement('p');

    nome.textContent = `Associado: ${associado.nome}`;
    cpf.textContent = `CPF: ${maskCpf(associado.cpf)}`;
    status.textContent = `Status: ${associado.cod_tipo_associado}`;
    target.append(nome, cpf, status);
};

let spinnerShow = (id) =>{
    document.getElementById(id).style.display = 'inline-block';
};

let spinnerStop=(id)=>{
    document.getElementById(id).style.display = 'none';
};

let hiddenAssociadosBox = ()=>{
    document.getElementById('associados-box').style.display = 'none';
};

let showVotacao = ()=>{
    let votacoesBoxes = document.querySelectorAll('.votacao-box');
    votacoesBoxes.forEach((value, key)=>{
        value.style.display = 'grid';
    });
};

let setVotacao = async ()=>{
    let response = await getSufragio();
    let result = await response.json();
    if(response.status != 200){
        desabilitarElemento('#entrar');
        let element = document.querySelector(`[data-erro="votacao"]`)
        element.innerHTML = result.message != null ? result.message : 'Votação não existe — Certifique-se que o link esteja correto!';
        element.style.display = "flex";
    }else{
        window.VOTACAO = {
            'sufragioId': result.id
        };
        setSendVotacao();
        setTitle(result.nome);
        setSubtitle(result.subtitulo);
        setDescription(result.descricao);
        setLinks(result.arquivos);
        if(verificaHorario(result.inicio, result.fim)){
            setQuestoes(result.questoes);
            document.getElementById('votar').addEventListener('click', ()=>{
                if(verificarPreenchimento(result.questoes)){
                    confirmar(result.questoes);
                }
            })
        }
    }
};

let verificaHorario = (inicio, fim)=>{
    let agora = new Date();
    inicio = new Date(inicio.replace(" ", "T") + "-03:00");
    fim = new Date(fim.replace(" ", "T") + "-03:00");
    if(inicio >= agora ){
        desabilitarElemento('#entrar');
        let element = document.querySelector(`[data-erro="votacao"]`);
        element.innerHTML = `Essa votação iniciará em ${inicio.toLocaleString("pt-br")} - Horário de Brasília`;
        element.style.display = "flex";

        return false;
    }

    if(inicio <= agora && fim <= agora){
        desabilitarElemento('#entrar');
        let element = document.querySelector(`[data-erro="votacao"]`);
        element.innerHTML = `Essa votação encerrou em ${fim.toLocaleString("pt-br")} - Horário de Brasília`;
        element.style.display = "flex";

        return false;
    }

    return true;
};

let desabilitarElemento = (element) => {
    document.querySelector(element).disabled = true;
};

let setQuestoes = (questoes)=>{
    questoes = ordenar(questoes, 'id');
    let target = document.getElementById('principal');
    let divButton = document.createElement('div');
    let btnVotar = document.createElement('button');

    divButton.classList.add('votacao-box', 'text-gray-600', 'dark:text-gray-400', 'text-sm');
    divButton.style.display = 'none';

    btnVotar.setAttribute('id', 'votar');
    btnVotar.classList.add('btn', 'btn-primary');
    btnVotar.textContent = 'Votar';

    divButton.append(btnVotar);

    questoes.forEach((value, key) => {

        let votacaoBox = document.createElement('div');
        votacaoBox.style.display = 'none';
        votacaoBox.classList.add('m-1', 'border', 'rounded', 'votacao-box', 'grid', 'grid-cols-1', 'md:grid-cols-2');

        let br = document.createElement('br');

        let div1 = document.createElement('div');
        let div2 = document.createElement('div');
        let divMargin1 = document.createElement('div');
        let divMargin2 = document.createElement('div');
        let divQuestao = document.createElement('div');
        let divRespostas = document.createElement('div');

        div1.classList.add('pt-0', 'p-6');
        div2.classList.add('p-6');
        divMargin1.classList.add('ml-12');
        divMargin2.classList.add('ml-12');
        divQuestao.classList.add('mt-2', 'text-gray-600', 'dark:text-gray-400', 'text-sm');
        divRespostas.classList.add('mt-2', 'text-gray-600', 'dark:text-gray-400', 'text-sm');

        let label = document.createElement('p');
        let limiteEscolhas = document.createElement('span');
        let complemento = document.createElement('p');

        divRespostas.classList.add('grid', 'respostas');
        divRespostas.setAttribute('data-questao', value.id);
        divRespostas.setAttribute('data-limite-escolhas', value.limiteEscolhas);
        divRespostas = setRespostas(value.id, value.respostas, divRespostas);

        limiteEscolhas.textContent = `Limite de escolhas: ${value.limiteEscolhas}`;
        limiteEscolhas.classList.add('small', 'text-muted', 'text-right');

        label.textContent = `${key + 1} - ${value.label}`;
        label.classList.add('text-lg', 'leading-4', 'font-semibold');

        value.complemento = (value.complemento == null || value.complemento == undefined) ? '' : value.complemento;

        complemento.textContent = `${value.complemento}`;
        complemento.classList.add('ml-4', 'text-md');

        label.append(br, limiteEscolhas);
        divQuestao.append(label);
        divMargin1.append(divQuestao, divRespostas);
        divMargin2.append(complemento);
        div1.append(divMargin1);
        div2.append(divMargin2);
        votacaoBox.append(div1, div2);

        target.append(votacaoBox);
    });
    target.append(divButton);
    setLimites();
    setVerificarPreenchimento(questoes);
};

let ordenar = (arr, by) => {
    return arr.sort(function(a,b) {
        return a.by < b.by ? -1 : a.by > b.by ? 1 : 0;
    });
};

let setRespostas = (questaoId, respostas, target) => {
    respostas.forEach((value, key)=>{
        let input = document.createElement('input');
        let label = document.createElement('label');
        let p = document.createElement('p');

        input.setAttribute('id', `resposta-${questaoId}-${value.id}`);
        input.setAttribute('name', `resposta-${questaoId}[]`);
        input.setAttribute('value', value.id);
        input.setAttribute('data-id-questao', questaoId);
        input.setAttribute('data-id-resposta', value.id);
        input.setAttribute('type', `checkbox`);
        label.setAttribute('for', `resposta-${questaoId}-${value.id}`);

        input.classList.add('form-check-input', 'mr-2');
        label.classList.add('form-check-label');
        p.classList.add('form-check');
        p.style.display = 'inline-flex';

        label.textContent = value.label;

        p.append(input, label);
        target.append(p);
    });
    return target;
};

let setTitle = (title)=>{
    let elements = document.querySelectorAll('[data-votacao]');
    elements.forEach((value, key)=>{
        value.innerHTML = title
    });
};

let setSubtitle = (subtitle)=>{
    subtitle = (subtitle == null || subtitle == undefined) ? '' : subtitle;
    let elements = document.querySelectorAll('[data-subtitle]');
    elements.forEach((value, key)=>{
        value.innerHTML = subtitle
    });
};

let setDescription = (description)=>{
    description = (description == null || description == undefined) ? '' : description;
    let elements = document.querySelectorAll('[data-description]');
    elements.forEach((value, key)=>{
        value.innerHTML = description
    });
};

let setLinks = (arquivos)=>{
    arquivos = (arquivos == null || arquivos == undefined) ? '' : arquivos;
    let elements = document.querySelectorAll('[data-links]');
    let p = document.createElement('p');

    arquivos.forEach((arquivo, key)=>{
        let a = document.createElement('a');
        a.classList.add('btn', 'btn-primary', 'btn-xl', 'js-scroll-trigger', 'bi', 'bi-download', 'm-1', 'col-7');
        a.setAttribute('target', '_blank');
        a.setAttribute('href', `/pdfs/${arquivo.sufragioId}/${arquivo.filename}`);
        a.textContent = ` ${arquivo.label}`;
        p.append(a);
    });

    elements.forEach((value, key)=>{
        value.append(p);
    });
};

let setErrors = (erros)=>{
    Object.entries(erros).forEach(([key, mensagem]) => {
        element = document.querySelector(`[data-erro="${key}"]`).innerHTML = mensagem;
    });
};

let getCpf = ()=>{
    return document.getElementById("cpf");
};

let setLimites = () => {
    let questoes = document.querySelectorAll(`[data-questao]`);
    questoes.forEach((questao, keyQuestion)=>{
        questao.addEventListener('change', ()=>{
            let inputChecked = questao.querySelectorAll('input[type=checkbox]:checked');
            let inputNotChecked = questao.querySelectorAll('input[type=checkbox]:not(:checked)');
            if(inputChecked.length >= questao.dataset.limiteEscolhas){
                bloquearInputs(inputNotChecked);
            }else{
                desbloquear(inputNotChecked);
            }
        });
    });
};

let bloquearInputs = (inputs) => {
    inputs.forEach((input, key)=>{
        input.disabled = true;
        input.classList.add('disabled');
    });
};

let desbloquear = (inputs)=>{
    inputs.forEach((input, key)=>{
        input.disabled = false;
        input.classList.toggle('disabled');
    });
};

let maskCpf = (entry) => {
    let digits=entry.replace(/\D/g,"");
    let mask=digits.replace(/(\d{3})(\d)/,"$1.$2");
    mask=mask.replace(/(\d{3})(\d)/,"$1.$2");
    mask=mask.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    return mask;
};

let setVerificarPreenchimento = (questoes) =>{
    let votar = document.getElementById('votar');
    votar.addEventListener('click', ()=>{verificarPreenchimento(questoes)});

    let voltar = document.getElementById('voltar');
    voltar.addEventListener('click', ()=>{
        window.GABARITO.hide();
    });
};

let verificarPreenchimento = (questoes)=>{
    let bool = true;
    questoes.forEach((questao)=>{
        let options = document.querySelector(`[data-questao="${questao.id}"]`);
        if(options.querySelectorAll('input[type=checkbox]:checked').length == 0){
            options.classList.add('border', 'border-danger', 'rounded', 'p-2');
            bool = false;
        }else{
            options.classList.remove('border', 'border-danger', 'rounded', 'p-2');
        }
    });
    return bool;
};

let confirmar = (questoes)=>{
    getEmail();
    getEscolhas(questoes);
    window.GABARITO.show();
};

let getEmail = ()=>{
    let email= document.querySelector('#email');
    email.value = (email.value == '') ? window.ASSOCIADO.email : email.value;
    window.VOTACAO.email = email.value;
}

let getEscolhas = (questoes)=>{
    let enviarVotacao = [];

    let escolhas = document.getElementById('escolhas');
    escolhas.innerHTML = null;
    let ulQuestoes = document.createElement('ul');
    ulQuestoes.style.listStyle = 'none';
    ulQuestoes.style.padding = '0px';
    questoes.forEach((questao, key)=>{
        let enviarQuestao = {};
        enviarQuestao.id = questao.id;
        enviarQuestao.respostas = [];
        let ulResposta = document.createElement('ul');
        ulResposta.style.listStyle = 'none';
        let liQuestao = document.createElement('li');

        liQuestao.style.padding = '10px';
        liQuestao.classList.add('border', 'rounded');
        liQuestao.textContent = `${key + 1} - ${questao.label}`;

        let options = document.querySelector(`[data-questao="${questao.id}"]`);
        options = options.querySelectorAll(`input[type="checkbox"]:checked`);
        options.forEach((option)=>{
            let liResposta = document.createElement('li');
            let label = document.querySelector(`[for="${option.id}"]`);
            enviarQuestao.respostas.push({"id" : option.value});
            liResposta.textContent = label.textContent;
            ulResposta.append(liResposta);
        });
        enviarVotacao.push(enviarQuestao);
        window.VOTACAO.questoes = enviarVotacao;
        liQuestao.append(ulResposta);
        ulQuestoes.append(liQuestao);
    });
    escolhas.append(ulQuestoes);
};

let votar = ()=>{
    getEmail();
    window.VOTACAO.nome = window.ASSOCIADO.nome
    window.VOTACAO.cpf = window.ASSOCIADO.cpf;
    return JSON.stringify(window.VOTACAO);
};

let setSendVotacao = ()=>{
    let confirmar = document.querySelector('#confirmar');
    confirmar.addEventListener('click', async ()=>{
        spinnerShow('spinner-confirmar');
        let response = await sendSufragio();
        let result = await response.json();
        spinnerStop('spinner-confirmar');
        window.GABARITO.hide();
        if(response.status!=200){
            let element = document.querySelector(`[data-erro="votacao"]`)
            element.innerHTML = result.message;
            element.style.display = "flex";
        }else{
            let comprovante = document.querySelector('#comprovante').innerHTML = `
                <p>${result.votos}</p>
                <p><b>ID votação:</b> ${result.sufragioId}</p>
                <p><b>Filiado:</b> ${result.tratamento ?? ''} ${result.nome}</p>
                <p><b>CPF:</b> ${result.cpf}</p>
                <p><b>Data e hora:</b> ${result.dataHora}</p>
                <p><b>IP:</b> ${result.ip}</p>
                <p><b>E-mail:</b> ${result.destinatario}</p>
            `;
            document.querySelector('#encerrar').addEventListener('click',()=>{
                window.location=`https://sinprofaz.org.br`;
            });
            window.COMPROVANTE.show();
        }
        desabilitarElemento('#votar')
        desabilitarElemento('#confirmar')
    });
}

document.addEventListener("DOMContentLoaded", function(e) {
    window.GABARITO = new bootstrap.Modal(document.getElementById('gabarito'));
    window.COMPROVANTE = new bootstrap.Modal(document.getElementById('modal-comprovante'));
    document.getElementById("cpf").onkeypress = onlyNumberKey;
    document.getElementById("cpf").onpaste = ()=>{return false};
    let btnEntar = document.getElementById("entrar")
    btnEntar.addEventListener('click', entrar);
    setVotacao();
});
