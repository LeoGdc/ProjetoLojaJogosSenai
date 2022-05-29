'use strict';

const images = [
    { 'id': '1', 'url':'./imgs/banner/Frame2.png'},
    { 'id': '2', 'url':'./imgs/banner/Frame3.png'},
    { 'id': '3', 'url':'./imgs/banner/Frame4.png'},
]

const containerItems = document.querySelector('#container-items');
console.log(containerItems)

const loadImages = ( images, container ) => {
    images.forEach ( image => {
        container.innerHTML += `
            <div class='item'>
                <img src='${image.url}'
            </div>
        `
    })
}
/////////////////////////////////////////////////////////////
let interval
const ligarAutomatico = () =>{
    if (interval) clearInterval(interval);

    interval -setInterval(() => next(), 7500);

}
ligarAutomatico();
/////////////////////////////////////////////////////////
loadImages( images, containerItems );

let items = document.querySelectorAll('.item');

const previous = () => {
    const lastItem = items[items.length - 1];
    containerItems.insertBefore( lastItem, items[0] );
    items = document.querySelectorAll('.item');
}

const next = () => {
    containerItems.appendChild(items[0]);
    items = document.querySelectorAll('.item');
}

document.querySelector('#previous').addEventListener('click', previous);
document.querySelector('#next').addEventListener('click', next);