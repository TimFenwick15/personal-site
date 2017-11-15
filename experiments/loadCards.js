'use strict'

let timer = false
let currentPosition = 0
const renderCards = () => {
  console.log('fetching cards...')
  fetch('cards.html')
    .then(x => {
      console.log('parsing cards...')
      return x.text()
    })
    .then(x => {
      // this currently only works with more. Current position needs setting on manual scroll, or manual scroll disabling
      console.log('rendering...')
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

const whichSectionIsOnScreen = () => {
  const sectionDistances = Array.from(document.getElementsByClassName('card-container')).map(x => x.scrollTop)
  //console.log(sectionDistances)
  return 1
}

let scrollCheckInterval
const scrollHandler_interval = () => {
  if (!scrollCheckInterval) {
    let lastHeightInPage = Array.from(document.getElementsByClassName('content')).map(x => x.offsetTop)
    scrollCheckInterval = setInterval(() => {
      if (lastHeightInPage === document.body.scrollTop) {
        //renderCards()
        clearInterval(scrollCheckInterval)
        scrollCheckInterval = null
        return 0
      }
      console.log('last: ', lastHeightInPage + ', scrollTop: ' + document.body.scrollTop)
      lastHeightInPage = document.body.scrollTop
    }, 200)
  }
}
window.addEventListener('scroll', scrollHandler_interval)

document.getElementById('more').addEventListener('click', () => {
  document.getElementsByClassName('page')[++currentPosition].scrollIntoView({
    behavior: 'smooth'
  })
  renderCards()
})
