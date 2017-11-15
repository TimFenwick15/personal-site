'use strict'

let timer = false
let currentPosition = 0
const renderCards = () => {
  fetch('/cards')
    .then(x => x.text())
    .then(x => {
      // this currently only works with more. Current position needs setting on manual scroll, or manual scroll disabling
      document.getElementsByClassName('card-container')[currentPosition].innerHTML = x
      setTimeout(() => document.getElementsByClassName('content')[currentPosition].className += ' transition-out', 2000)
      setTimeout(() => Array.from(document.getElementsByClassName('card')).forEach(card => card.className += ' transition-in'), 2000)
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
  document.getElementsByClassName('page')[++currentPosition].scrollIntoView({
    behavior: 'smooth'
  })
  renderCards()
})
