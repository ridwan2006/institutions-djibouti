// Variables globales
let institutionsData = []
let currentView = "grid"
let currentSortColumn = null
let currentSortDirection = "asc"
let feather // Declare feather variable
let google // Declare google variable

// Initialisation
document.addEventListener("DOMContentLoaded", () => {
  initializeData()
  setupEventListeners()
  updateResultsCount()
})

// Récupération des données depuis le DOM
function initializeData() {
  const gridCards = document.querySelectorAll(".institution-card")
  const tableRows = document.querySelectorAll(".institution-row")

  institutionsData = []

  Array.from(gridCards).forEach((element) => {
    institutionsData.push({
      element: element,
      name: element.dataset.name || "",
      type: element.dataset.type || "",
      description: element.dataset.description || "",
      visible: true,
      source: "grid",
    })
  })

  Array.from(tableRows).forEach((element) => {
    const existingItem = institutionsData.find(
      (item) => item.name === (element.dataset.name || "") && item.source === "grid",
    )

    if (!existingItem) {
      institutionsData.push({
        element: element,
        name: element.dataset.name || "",
        type: element.dataset.type || "",
        description: element.dataset.description || "",
        visible: true,
        source: "table",
      })
    } else {
      existingItem.tableElement = element
    }
  })
}

// Configuration des événements
function setupEventListeners() {
  const navToggle = document.getElementById("nav-toggle")
  if (navToggle) {
    navToggle.addEventListener("click", toggleMobileNav)
  }

  const searchInput = document.getElementById("search-input")
  if (searchInput) {
    let searchTimeout
    searchInput.addEventListener("input", function () {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(performSearch, 300)

      const clearBtn = document.getElementById("search-clear")
      if (clearBtn) {
        clearBtn.style.display = this.value ? "block" : "none"
      }
    })
  }

  const searchClear = document.getElementById("search-clear")
  if (searchClear) {
    searchClear.addEventListener("click", clearSearch)
  }

  const typeFilter = document.getElementById("type-filter")
  if (typeFilter) typeFilter.addEventListener("change", performSearch)

  const viewToggle = document.getElementById("view-toggle")
  if (viewToggle) {
    viewToggle.addEventListener("click", toggleView)
  }

  const sortableHeaders = document.querySelectorAll(".sortable")
  sortableHeaders.forEach((header) => {
    header.addEventListener("click", function () {
      const column = this.dataset.column
      handleSort(column)
    })
  })

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeInstitutionModal()
    }
  })

  const modalOverlay = document.getElementById("institution-modal")
  if (modalOverlay) {
    modalOverlay.addEventListener("click", function (e) {
      if (e.target === this) {
        closeInstitutionModal()
      }
    })
  }
}

// Navigation mobile
function toggleMobileNav() {
  const navLinks = document.querySelector(".nav-links")
  const navToggle = document.getElementById("nav-toggle")

  if (navLinks && navToggle) {
    navLinks.classList.toggle("active")
    navToggle.classList.toggle("active")
  }
}

// Recherche et filtrage
function performSearch() {
  const searchTerm = document.getElementById("search-input")?.value.toLowerCase().trim() || ""
  const selectedType = document.getElementById("type-filter")?.value.toLowerCase() || ""

  let visibleCount = 0

  institutionsData.forEach((institution) => {
    let isVisible = true

    if (searchTerm) {
      const matchesSearch =
        institution.name.toLowerCase().includes(searchTerm) ||
        institution.type.toLowerCase().includes(searchTerm) ||
        institution.description.toLowerCase().includes(searchTerm)

      if (!matchesSearch) {
        isVisible = false
      }
    }

    if (selectedType && isVisible) {
      if (!institution.type.toLowerCase().includes(selectedType)) {
        isVisible = false
      }
    }

    institution.visible = isVisible
    institution.element.style.display = isVisible ? "" : "none"

    if (institution.tableElement) {
      institution.tableElement.style.display = isVisible ? "" : "none"
    }

    if (isVisible) {
      visibleCount++
    }
  })

  updateResultsDisplay(visibleCount, searchTerm, selectedType)
}

// Effacer la recherche
function clearSearch() {
  const searchInput = document.getElementById("search-input")
  const typeFilter = document.getElementById("type-filter")
  const searchClear = document.getElementById("search-clear")

  if (searchInput) searchInput.value = ""
  if (typeFilter) typeFilter.value = ""
  if (searchClear) searchClear.style.display = "none"

  performSearch()
}

// Toggle vue grille/tableau
function toggleView() {
  const gridView = document.getElementById("institutions-grid")
  const tableView = document.getElementById("institutions-table-container")
  const toggleIcon = document.getElementById("toggle-icon")
  const toggleText = document.getElementById("toggle-text")

  if (currentView === "grid") {
    if (gridView) gridView.style.display = "none"
    if (tableView) tableView.style.display = "block"
    if (toggleIcon) toggleIcon.setAttribute("data-feather", "grid")
    if (toggleText) toggleText.textContent = "Vue grille"
    currentView = "table"
  } else {
    if (gridView) gridView.style.display = "grid"
    if (tableView) tableView.style.display = "none"
    if (toggleIcon) toggleIcon.setAttribute("data-feather", "list")
    if (toggleText) toggleText.textContent = "Vue tableau"
    currentView = "grid"
  }

  if (typeof feather !== "undefined") {
    feather.replace()
  }
}

// Gestion du tri
function handleSort(column) {
  if (currentSortColumn === column) {
    currentSortDirection = currentSortDirection === "asc" ? "desc" : "asc"
  } else {
    currentSortColumn = column
    currentSortDirection = "asc"
  }

  const visibleInstitutions = institutionsData.filter((inst) => inst.visible)

  visibleInstitutions.sort((a, b) => {
    let valueA, valueB

    switch (column) {
      case "name":
        valueA = a.name
        valueB = b.name
        break
      case "type":
        valueA = a.type
        valueB = b.type
        break
      default:
        return 0
    }

    const comparison = valueA.localeCompare(valueB, "fr", {
      numeric: true,
      sensitivity: "base",
    })

    return currentSortDirection === "asc" ? comparison : -comparison
  })

  const container =
    currentView === "grid"
      ? document.getElementById("institutions-grid")
      : document.querySelector("#institutions-tbody")

  if (container) {
    visibleInstitutions.forEach((institution) => {
      if (currentView === "grid") {
        container.appendChild(institution.element)
      } else if (institution.tableElement) {
        container.appendChild(institution.tableElement)
      }
    })
  }

  updateSortIcons(column)
}

// Mise à jour des icônes de tri
function updateSortIcons(activeColumn) {
  const sortableHeaders = document.querySelectorAll(".sortable")

  sortableHeaders.forEach((header) => {
    const icon = header.querySelector(".sort-icon")
    const column = header.dataset.column

    if (icon) {
      if (column === activeColumn) {
        const iconName = currentSortDirection === "asc" ? "chevron-up" : "chevron-down"
        icon.setAttribute("data-feather", iconName)
        icon.style.color = "#000000"
      } else {
        icon.setAttribute("data-feather", "chevrons-up-down")
        icon.style.color = "#737373"
      }
    }
  })

  if (typeof feather !== "undefined") {
    feather.replace()
  }
}

// Mise à jour de l'affichage des résultats
function updateResultsDisplay(visibleCount, searchTerm = "", selectedType = "") {
  const noResults = document.getElementById("no-results")
  const gridView = document.getElementById("institutions-grid")
  const tableView = document.getElementById("institutions-table-container")

  if (visibleCount === 0) {
    if (noResults) noResults.style.display = "block"
    if (gridView) gridView.style.display = "none"
    if (tableView) tableView.style.display = "none"
  } else {
    if (noResults) noResults.style.display = "none"

    if (currentView === "grid") {
      if (gridView) gridView.style.display = "grid"
      if (tableView) tableView.style.display = "none"
    } else {
      if (gridView) gridView.style.display = "none"
      if (tableView) tableView.style.display = "block"
    }
  }

  updateResultsCount(visibleCount, searchTerm, selectedType)
}

// Mise à jour du compteur
function updateResultsCount(visibleCount = null, searchTerm = "", selectedType = "") {
  const resultsCount = document.getElementById("results-count")
  const totalInstitutions = document.getElementById("total-institutions")

  if (!resultsCount) return

  if (visibleCount === null) {
    visibleCount = institutionsData.length
  }

  if (totalInstitutions) {
    totalInstitutions.textContent = institutionsData.length
  }

  let message = ""
  const hasFilters = searchTerm || selectedType

  if (hasFilters) {
    message = `${visibleCount} institution${visibleCount > 1 ? "s" : ""} trouvée${visibleCount > 1 ? "s" : ""}`

    const filters = []
    if (searchTerm) filters.push(`"${searchTerm}"`)
    if (selectedType) filters.push(`type "${selectedType}"`)

    if (filters.length > 0) {
      message += ` pour ${filters.join(", ")}`
    }
  } else {
    message = `Affichage de ${visibleCount} institution${visibleCount > 1 ? "s" : ""}`
  }

  resultsCount.textContent = message
}

// Gestion des modals
function openInstitutionModal(data) {
  const modal = document.getElementById("institution-modal")
  const modalTitle = document.getElementById("modal-title")
  const modalBody = document.getElementById("modal-body")

  if (!modal || !modalTitle || !modalBody) {
    return
  }

  modalTitle.textContent = data.name || "Institution"
  modalBody.innerHTML = generateModalContent(data)

  modal.style.display = "flex"
  modal.style.opacity = "0"
  document.body.style.overflow = "hidden"

  setTimeout(() => {
    modal.style.opacity = "1"
  }, 10)

  if (typeof feather !== "undefined") {
    feather.replace()
  }
}

function closeInstitutionModal() {
  const modal = document.getElementById("institution-modal")

  if (modal) {
    modal.style.opacity = "0"
    setTimeout(() => {
      modal.style.display = "none"
      document.body.style.overflow = ""
    }, 200)
  }
}

// Génération du contenu modal
function generateModalContent(data) {
  return `
       <div class="modal-institution-content">
           <div class="detail-grid">
               ${
                 data.email
                   ? `
               <div class="detail-item">
                   <div class="detail-label">
                       <i data-feather="mail"></i>
                       EMAIL
                   </div>
                   <div class="detail-value">
                       <a href="mailto:${data.email}">${data.email}</a>
                   </div>
               </div>
               `
                   : ""
               }
               
               ${
                 data.phone
                   ? `
               <div class="detail-item">
                   <div class="detail-label">
                       <i data-feather="phone"></i>
                       TÉLÉPHONE
                   </div>
                   <div class="detail-value">
                       <a href="tel:${data.phone}">${data.phone}</a>
                   </div>
               </div>
               `
                   : ""
               }
               
               ${
                 data.address
                   ? `
               <div class="detail-item">
                   <div class="detail-label">
                       <i data-feather="map-pin"></i>
                       ADRESSE
                   </div>
                   <div class="detail-value">${data.address}</div>
               </div>
               `
                   : ""
               }
               
               ${
                 data.hours
                   ? `
               <div class="detail-item">
                   <div class="detail-label">
                       <i data-feather="clock"></i>
                       HORAIRES
                   </div>
                   <div class="detail-value">${data.hours}</div>
               </div>
               `
                   : ""
               }
               
               ${
                 data.website && data.website.trim()
                   ? `
               <div class="detail-item">
                   <div class="detail-label">
                       <i data-feather="globe"></i>
                       SITE WEB
                   </div>
                   <div class="detail-value">
                       <a href="${data.website}" target="_blank" rel="noopener noreferrer">${data.website}</a>
                   </div>
               </div>
               `
                   : ""
               }
           </div>
           
           ${
             data.description && data.description.trim()
               ? `
           <div class="modal-description">
               <h4>Description</h4>
               <p>${data.description}</p>
           </div>
           `
               : ""
           }
           
           <div class="modal-actions">
               ${
                 data.phone
                   ? `
               <a href="tel:${data.phone}" class="btn-primary">
                   <i data-feather="phone"></i>
                   Appeler
               </a>
               `
                   : ""
               }
               ${
                 data.email
                   ? `
               <a href="mailto:${data.email}" class="btn-outline">
                   <i data-feather="mail"></i>
                   Envoyer un email
               </a>
               `
                   : ""
               }
               ${
                 data.website && data.website.trim()
                   ? `
               <a href="${data.website}" target="_blank" rel="noopener noreferrer" class="btn-outline">
                   <i data-feather="external-link"></i>
                   Visiter le site
               </a>
               `
                   : ""
               }
           </div>
       </div>
   `
}

// Navigation fluide
function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId)
  if (section) {
    const navHeight = document.querySelector(".navbar")?.offsetHeight || 70
    const targetPosition = section.offsetTop - navHeight - 20

    window.scrollTo({
      top: targetPosition,
      behavior: "smooth",
    })
  }
}

// Carte Google Maps - fonction globale pour l'API
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 11.588, lng: 43.145 },
    zoom: 14,
  })

  const service = new google.maps.places.PlacesService(map)

  service.textSearch(
    {
      location: map.getCenter(),
      radius: 10000,
      query: "ministère",
    },
    (results, status) => {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        results.forEach((place) => {
          const marker = new google.maps.Marker({
            map,
            position: place.geometry.location,
            title: place.name,
          })

          const infowindow = new google.maps.InfoWindow({
            content: `
              <div style="max-width: 250px;">
                <strong>${place.name}</strong><br>
                ${place.formatted_address || ""}<br>
              </div>
            `,
          })

          marker.addListener("click", () => {
            infowindow.open(map, marker)
          })
        })
      }
    },
  )
}

// Exposition globale pour l'API Google Maps
window.initMap = initMap
