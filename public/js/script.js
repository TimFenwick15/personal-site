'use strict'

const sectionFactory = (position, dataTypeArg) => {
  const dataType = dataTypeArg
  const section = document.getElementsByClassName('page')[position]
  const title = section.getElementsByClassName('content')[0]
  let cardContainer = null
  let isRendered = true
  if (dataType) {
    cardContainer = section.getElementsByClassName('card-container')[0]
    isRendered = false
  }
  return {
    title,
    cardContainer,
    scrollTo: () => {
      title.scrollIntoView({
        block: "start", inline: "nearest", behavior: 'smooth'
      })
    },
    render: () => {
      if (!isRendered) {
        isRendered = true
        const loading = document.getElementsByClassName('loading')[0]
        loading.className = 'loading'
        fetch(`/${dataType}`)
          .then(x => x.text())
          .then(x => {
            cardContainer.innerHTML = x

            // We need a short delay here or the content it rendered before the styles apply
            setTimeout(
              () => {
                loading.className += ' transition-out'
                Array.from(cardContainer.getElementsByClassName('card'))
                  .forEach(card => card.className += ' transition-in')
              }, 100)
          })
      }
    }
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
      window.addEventListener('scroll', () => setTimeout(() => getCurrentSection().render(), 500))
      document.getElementById('more').addEventListener('click', () => getCurrentSection(1).scrollTo())
    }
  }
}

const intro = sectionFactory(0)
const feed = sectionFactory(1, 'data')
const contact = sectionFactory(2, 'contact')
const p = page({intro, feed, contact})
p.registerEventListeners()
