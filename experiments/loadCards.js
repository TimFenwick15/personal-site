'use strict'

let timer = false
let currentPosition = 0
const renderCards = () => {
  const section = document.getElementsByClassName('card-container')[currentPosition]
  const typeOfSection = section.className.indexOf('data') !== - 1 ? 'data' : 'contact' // this shouldn't be decided by a CSS class (?)
  fetch('cards.html')
    .then(x => x.text())
    .then(x => {
      // this currently only works with more. Current position needs setting on manual scroll, or manual scroll disabling
      document.getElementsByClassName('card-container')[currentPosition].innerHTML = x
      Array.from(document.getElementsByClassName('card')).forEach(card => card.className += ' transition-in')
    })
  //window.removeEventListener('scroll', scrollHandler)
}
/*const scrollHandler = () => {
  if (!timer) {
    timer = true
    setTimeout(renderCards, 300)
  }
}
window.addEventListener('scroll', scrollHandler)*/

document.getElementById('more').addEventListener('click', () => {
  document.getElementsByClassName('content')[++currentPosition].scrollIntoView({
    block: "start", inline: "nearest", behavior: 'smooth'
  })
  renderCards()
})
