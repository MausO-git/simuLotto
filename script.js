const num = document.querySelector('.num');
const star = document.querySelector('.star');
const play = document.querySelector('.tirage');

const nns = document.querySelectorAll('.nn');
const nss = document.querySelectorAll('.ns');

const zoneMise = document.querySelector('.mise .n');
const zoneGain = document.querySelector('.gain .n');
const zoneDiff = document.querySelector('.diff .n');

let simpleNum = [];
let starNum = [];
let chooseNum = 0;
let chooseStar = 0;

const updateMoney = (mise, gain)=>{
    zoneMise.textContent = (mise/100).toFixed(2) + " €"
    zoneGain.textContent = (gain/100).toFixed(2) + " €"
    zoneDiff.textContent = ((gain - mise)/100).toFixed(2) + " €"
}

updateMoney(window.sessionData.mise, window.sessionData.gain);

//génération de cases

for(let i = 0;i<50;i++){
    const newCase = document.createElement('div');
    newCase.textContent = i+1;
    newCase.classList.add('case');
    num.appendChild(newCase);
}

for(let i = 0;i<12;i++){
    const newCase = document.createElement('div');
    newCase.textContent = i+1;
    newCase.classList.add('starCase');
    star.appendChild(newCase);
}

//choix des numéros

num.addEventListener('click', (e)=>{
    const elem = e.target;
    if(!elem.classList.contains('case')) return;

    const val = parseInt(elem.textContent);
    if(!elem.classList.contains('choose') && chooseNum<5){
        elem.classList.add('choose');
        simpleNum.push(val);
        chooseNum++;
    }else if(elem.classList.contains('choose')){
        elem.classList.remove('choose');
        simpleNum = simpleNum.filter(n => n !== val);
        chooseNum--;
    }else{
        return;
    }
});

star.addEventListener('click', (e)=>{
    const elem = e.target;
    if(!elem.classList.contains('starCase')) return;

    const val = parseInt(elem.textContent);
    if(!elem.classList.contains('choose') && chooseStar<2){
        elem.classList.add('choose');
        starNum.push(val);
        chooseStar++;
    }else if(elem.classList.contains('choose')){
        elem.classList.remove('choose');
        starNum = starNum.filter(n => n !== val);
        chooseStar--;
    }else{
        return;
    }
});

play.addEventListener('click', ()=>{
    if(simpleNum.length < 5 || starNum < 2){
        alert("Séléctionnez 5 numéros et 2 étoiles pour jouer");
        return;
    }

    fetch("api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            numeros: simpleNum,
            etoiles: starNum
        })
    })
    .then(res => res.json())
    .then(data => {
        data.tirage.forEach((val, i)=> nns[i].textContent = val);
        data.etoiles.forEach((val, i)=> nss[i].textContent = val);

        updateMoney(data.mise, data.gain);

        console.log("Points:", data.pointsNum, data.pointsStar, "Gain:", data.gain);
    })
})