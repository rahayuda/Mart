function toggleDropdown1() {
  var dropdown = document.getElementById("myDropdown1");
  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
}

function toggleDropdown2() {
  var dropdown = document.getElementById("myDropdown2");
  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
}

function toggleDropdown3() {
  var dropdown = document.getElementById("myDropdown3");
  if (dropdown.style.display === "none" || dropdown.style.display === "") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
  }
}

const cards = document.querySelectorAll('.product');

cards.forEach(card => {
  card.addEventListener('mouseenter', function() {
    this.classList.add('hover');
  });

  card.addEventListener('mouseleave', function() {
    this.classList.remove('hover');
  });
});