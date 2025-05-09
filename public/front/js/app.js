const swiper = new Swiper(".swiper", {
    direction: "horizontal",
    loop: true,
    slidesPerView: 3,
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
    pagination: {
        el: ".swiper-pagination",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    scrollbar: {
        el: ".swiper-scrollbar",
    },
});


jalaliDatepicker.startWatch();
let stars = document.querySelectorAll(".star");

stars.forEach(function (star) {
    star.addEventListener("click", function () {
        selectedStars = parseInt(star.getAttribute("data-star"), 10);

        stars.forEach(function (s) {
            s.classList.remove("checked");
        });

        for (var i = 1; i <= selectedStars; i++) {
            document
                .querySelector('.star[data-star="' + i + '"]')
                .classList.add("checked");
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".nav-tabs .nav-link");
    const panes = document.querySelectorAll(".tab-pane");
  
    tabs.forEach((tab) => {
      tab.addEventListener("click", function (event) {
        event.preventDefault();
  
        tabs.forEach((t) => t.classList.remove("activelist"));
  
        tab.classList.add("activelist");
  
        panes.forEach((pane) => pane.classList.remove("activelist", "show"));
  
        const target = document.querySelector(tab.getAttribute("href"));
        target.classList.add("activelist", "show");
      });
    });
  
    tabs[0].click();
  });
  

// const addReviewBtn = document.querySelector("#add-review");
//
// function showAlert() {
//     let selectedStars = 0;
//
//     Swal.fire({
//         title: "ثبت نظر",
//         html: `
// <!--            <div id="stars" class="mt-3">-->
// <!--                <i class="bi bi-star star" data-star="1"></i>-->
// <!--                <i class="bi bi-star star" data-star="2"></i>-->
// <!--                <i class="bi bi-star star" data-star="3"></i>-->
// <!--                <i class="bi bi-star star" data-star="4"></i>-->
// <!--                <i class="bi bi-star star" data-star="5"></i>-->
// <!--            </div>-->
//             <textarea id="comment" wire:model="text" class="swal2-textarea" placeholder="نظر شما"></textarea>
//             <button wire:click="save()">dwa</button>
//         `,
//         showCancelButton: true,
//         cancelButtonText: "انصراف ",
//         confirmButtonText: "ثبت نظر",
//     });
//
//
// }
//
// addReviewBtn.addEventListener("click", showAlert);
