'use strict'

let timer = false
let currentPosition = 0

// Render Cards in the current position
const renderCards = () => {
  //const section = document.getElementsByClassName('card-container')[currentPosition]
  const section = document.getElementsByClassName('content')[currentPosition]
  const typeOfSection = section.className.indexOf('data') !== - 1 ? 'data' : 'contact'
  const loading = document.getElementsByClassName('loading')[0]
  loading.className = 'loading'
  fetch('/' + typeOfSection)
    .then(x => x.text())
    .then(x => {
      document.getElementsByClassName('card-container')[currentPosition - 1].innerHTML = x

      // We need a short delay here or the content it rendered before the styles apply
      setTimeout(
        () => {
          loading.className += ' transition-out'
          Array.from(document.getElementsByClassName('card'))
            .forEach(card => card.className += ' transition-in')
        }, 100)
    })
}

// Pick a position and render the cards in the position scrolled to
const renderCurrentSection = () => {
  const originalPosition = currentPosition
  const section = Array.from(document.getElementsByClassName('content'))
  const titlePositions = section
    .map(x => x.getBoundingClientRect().top)
  if (titlePositions[0] >= - 1)
    currentPosition = 0
  else if (titlePositions[1] >= - 1)
    currentPosition = 1
  else {
    currentPosition = 2
    document.getElementById('more').style.display = 'none'
  }
  if (originalPosition !== currentPosition && currentPosition !== 0)
    renderCards()
  timer = false
}
const scrollHandler = () => {
  if (!timer) {
    timer = true
    setTimeout(renderCurrentSection, 500)
  }
}
window.addEventListener('scroll', scrollHandler)

// The More button
document.getElementById('more').addEventListener('click', () => {
  document.getElementsByClassName('content')[currentPosition + 1].scrollIntoView({
    block: "start", inline: "nearest", behavior: 'smooth'
  })
})
