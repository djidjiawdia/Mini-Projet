const form = document.querySelector('#formQ');
const mutliRespEl = document.getElementById('resp');

if(form){

    /** Afficher reponse en fontion du type choisi */
    form.type.addEventListener('change', e => {
        if(e.target.value === 'texte'){
            const div = document.createElement('div');
            const label = document.createElement('label');
            const input = document.createElement('input');
            mutliRespEl.innerHTML = '';
            div.setAttribute('class', 'form-group-q');
            label.setAttribute('for', 'rep');
            label.textContent = 'Réponse';
            input.setAttribute('class', 'form-control-q')
            input.setAttribute('name', 'rep')
            input.setAttribute('id', 'rep')
            div.append(label);
            div.append(input);
            mutliRespEl.append(div);
        }else{
            const div = document.createElement('div');
            const label = document.createElement('label');
            const input = document.createElement('input');
            div.setAttribute('class', 'form-group-q');
            label.setAttribute('for', 'nbrRep');
            label.innerHTML = "Nombre Réponse";
            input.setAttribute('class', 'form-control-q');
            input.setAttribute('id', 'nbrRep');
            input.setAttribute('name', 'nbrRep');
            input.setAttribute('type', 'number');
            div.append(label, input);
            mutliRespEl.innerHTML = '';
            mutliRespEl.append(div);
        }
    })
    
    /** Ajouter le nombre de reponse */
    form.nbrRep.addEventListener("keyup", e => {
        if(e.target.value == 0 || e.target.value == 1){
            mutliRespEl.innerHTML = '';
        }
        if(e.target.value > 1 && e.target.value <=5){
            mutliRespEl.innerHTML = '';
            for(i=0; i<e.target.value; i++){
                const div = document.createElement('div');
                const label = document.createElement('label');
                const input = document.createElement('input');
                const input2 = document.createElement('input');
                div.setAttribute('class', 'form-group-q');
                label.setAttribute('for', `rep${i+1}`);
                label.textContent = `Réponse ${i+1}`;
                input.setAttribute('class', 'form-control-q');
                input.setAttribute('type', 'text');
                input.setAttribute('name', `rep${i+1}`);
                input.setAttribute('id', `rep${i+1}`);
                input2.setAttribute('type', form.type.value);
                input2.setAttribute('name', 'repC[]');
                input2.setAttribute('value', `rep${i+1}`);
                input2.style.marginLeft = '10px';
                input2.style.width = '30px';
                input2.style.height = '30px';
                div.append(label);
                div.append(input);
                div.append(input2);
                mutliRespEl.append(div);
            }
        }
    })
}

/************************************** PAGINATION **************************************/
const formRepEl = document.getElementById("repForm");
const tabEl = document.getElementsByClassName('tab');
let score = 0;
let check = true;

let currentTab = 0; // Numero de la page courante
formRepEl.addEventListener('submit', e => {
    if(currentTab < tabEl.length){
        e.preventDefault();
    }
})

showTab = (n) => {
    // This function will display the specified tab of the form ...
    tabEl[n].style.display = 'flex';
    // FIx button prev / next
    if(n == 0){
        document.getElementById("prec").style.display = 'none';
    }else{
        document.getElementById("prec").style.display = '';
    }
    if(n == (tabEl.length - 1)){
        document.getElementById("suiv").innerText = 'Terminer';
        document.getElementById("suiv").setAttribute('name', 'terminer');
        document.getElementById("suiv").setAttribute('type', 'submit');
    }else{
        document.getElementById("suiv").innerHTML = 'Suivant';
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n);
}

next = () => {// Hide the current Tab
    tabEl[currentTab].style.display = 'none';
    // Increase the current tab by 1:
    if(tabs[currentTab].type === 'texte'){
        disabled = tabEl[currentTab].querySelector('input[id=repText]').disabled;
    }else{
        disabled = tabEl[currentTab].querySelector('input[id=resp]').disabled;
    }
    if(check && !disabled){
        console.log('verify', verifierRep());
        if(verifierRep()){
            score += parseInt(tabs[currentTab].score);
            document.getElementsByClassName("step")[currentTab].className += " true";
        }else{
            document.getElementsByClassName("step")[currentTab].className += " false";
        };
    }
    
    updateForm(currentTab);
    currentTab++;
    // if you have reached the end of the form... :
    if (currentTab >= tabEl.length) {
        //...the form gets submitted:
        formRepEl.submit();
        formRepEl.innerHTML = '';
        const h2 = document.createElement('h2');
        const btn = document.createElement('button');
        if(score === scoreTabs()){
            const h1 = document.createElement('h1');
            h1.innerHTML = 'Bravooo vous avez réussi à tout trouver!!!!';
            formRepEl.append(h1);
        }
        btn.setAttribute('type', 'submit');
        btn.classList.add('btn-res', 'btn-active');
        btn.innerHTML = 'Rejouer';
        h2.innerHTML = `Score : ${score}`;
        formRepEl.append(h2);
        formRepEl.append(btn);
        //return false;
    }
    // Otherwise, display the correct tab:
    check = true;
    showTab(currentTab);
}
prev = () => {// Hide the current Tab
    tabEl[currentTab].style.display = 'none';
    check = false;
    // Increase or decrease the current tab by 1:
    currentTab--;
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

verifierRep = () => {
    // This function deals with validation of the form fields
    const inputEl = tabEl[currentTab].querySelectorAll('input[id=resp]:checked');
    const inputTextEl = tabEl[currentTab].querySelectorAll('input[id=repText]');
    // Verifier si les réponses sont identiques
    if((tabs[currentTab]).type === 'texte'){
        return tabs[currentTab].rep.toLowerCase() == inputTextEl[0].value.toLowerCase();
    }else{
        let checkboxesChecked = [];
        for (var i=0; i<inputEl.length; i++) {
            // And stick the checked ones onto an array...
            if (inputEl[i].checked) {
               checkboxesChecked.push(inputEl[i].value);
            }
        }
        return tabs[currentTab].repC.join() == checkboxesChecked.join();
    }
    
}

updateForm = (n) => {
    const inputEl = tabEl[n].querySelectorAll('#resp');
    const inputTextEl = tabEl[currentTab].querySelector('input[id=repText]');
    if((tabs[currentTab]).type === 'texte'){
        inputTextEl.setAttribute('disabled', '');
    }else{
        for (i = 0; i < inputEl.length; i++) {
            inputEl[i].setAttribute('disabled', '');
        }
    }
}

fixStepIndicator = (n) => {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
}

scoreTabs = () => {
    let scores = 0;
    for(i=0; i<tabs.length; i++){
        scores += parseInt(tabs[i].score);
    }
    return scores;
}

showTab(currentTab);
