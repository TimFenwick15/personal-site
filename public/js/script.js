'use strict'

const addClass = (element, className) => {
  const currentClassName = element.className
  if (currentClassName.indexOf(className) === -1) {
    element.className += ` ${className}`
  }
}
const sectionFactory = (position, dataTypeArg) => {
  const dataType = dataTypeArg
  const section = document.getElementsByClassName('page')[position]
  const title = section.getElementsByClassName('content')[0]
  let cardContainer = null
  let isRendered = true
  let numberOfCardsToRender = 0
  if (dataType) {
    cardContainer = section.getElementsByClassName('card-container')[0]
    isRendered = false
  }
  const render = () => {
    const cardList = Array.from(cardContainer.getElementsByClassName('card'))
    const moreCardsButton = section.getElementsByClassName('more-cards')[0]
    const alreadyRenderedCards = numberOfCardsToRender
    if (cardList.length > numberOfCardsToRender) {
      if (cardList.length > numberOfCardsToRender + 10) {
        numberOfCardsToRender += 10
      }
      else {
        numberOfCardsToRender = cardList.length
      }
    }
    if (cardList.length === numberOfCardsToRender) {
      addClass(moreCardsButton, 'transition-out')
    }
    else {
      addClass(moreCardsButton, 'transition-in')
    }
    for (let i = alreadyRenderedCards; i < numberOfCardsToRender; i++) {
      addClass(cardList[i], 'transition-in')
    }
  }
  return {
    title,
    cardContainer,
    scrollTo: () => {
      title.scrollIntoView({
        block: "start", inline: "nearest", behavior: 'smooth'
      })
    },
    load: () => {
      if (!isRendered) {
        isRendered = true
        const loading = document.getElementsByClassName('loading')[0]
        loading.className = 'loading'
        fetch(`/${dataType}`)
          .then(x => x.text())
          .then(x => {
            cardContainer.innerHTML = x
            addClass(loading, 'transition-out')
            setTimeout(render, 100)
          })
      }
    },
    render
  }
}

const page = (pageSectionsArg) => {
  const pageSections = pageSectionsArg
  const getCurrentSection = (offset = 0) => {
    const section = Array.from(document.getElementsByClassName('content'))
    const titlePositions = section.map(x => x.getBoundingClientRect().top)
    for (let i = 0; i < titlePositions.length; i++)
      if (titlePositions[i] >= - 1)
        return pageSections[Object.keys(pageSections)[( i + offset ) % titlePositions.length]]
  }
  return {
    registerEventListeners: () => {
      window.addEventListener('scroll', () => setTimeout(() => getCurrentSection().load(), 500))
      
      Array.from(document.getElementsByClassName('more-cards')).forEach(button => {
        button.addEventListener('click', () => getCurrentSection().render())
      })

      document.getElementById('more').addEventListener('click', () => getCurrentSection(1).scrollTo())
    }
  }
}

const intro = sectionFactory(0)
const feed = sectionFactory(1, 'data')
const contact = sectionFactory(2, 'contact')
const p = page({intro, feed, contact})
p.registerEventListeners()
