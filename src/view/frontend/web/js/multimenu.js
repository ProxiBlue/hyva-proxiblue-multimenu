'use strict';

const initMenu = () => {
    return {
        open: false,
        setActiveMenu(menuNode) {
            Array.from(menuNode.querySelectorAll('a')).filter(link => {
                return link.href === window.location.href.split('?')[0];
            }).map(item => {
                item.classList.add('underline');
                item.closest('div.level-0') &&
                item.closest('div.level-0').querySelector('a.level-0').classList.add('underline');
            });
        },
        checkSlideDirection(event) {
            let domElm = event.target
            var NavElm = document.getElementById('nav-mobile-container');
            if (NavElm.innerHTML.trim() == '') {
                if (domElm.nextElementSibling) {
                    let UlElm = domElm.nextElementSibling;
                    return new Promise((resolve, reject) => {
                        UlElm.classList.remove('slide-to-left');
                        UlElm.classList.remove('slide-to-right')
                        return resolve();
                    })
                        .then(() => {
                            if ((domElm.getBoundingClientRect().right + UlElm.offsetWidth) > window.innerWidth) {
                                UlElm.style.right = domElm.offsetWidth + 12 + "px";
                                UlElm.style.zIndex = -1;
                                UlElm.classList.add('slide-to-left')
                                this.slideToLeft = true;
                            } else {
                                UlElm.classList.add('slide-to-right');
                                this.slideToLeft = false;
                                UlElm.style.right = 0;
                            }
                        });

                }
            }
        },
        handleMobileOpenMenu(event) {
            if (event.target.localName == 'svg') {
                var domElm = event.target.parentElement.parentElement;
            } else {
                var domElm = event.target.parentElement.parentElement.parentElement;
            }
            if (domElm.nextElementSibling) {
                let UlElm = domElm.nextElementSibling;
                let parent = domElm;
                if (parent.classList.contains('menu-active')) {
                    parent.classList.remove('menu-active');
                    domElm.classList.remove('menu-active');
                    UlElm.classList.remove('open-down');
                } else {
                    parent.classList.add('menu-active');
                    domElm.classList.add('menu-active');
                    UlElm.classList.add('open-down');
                }

            }

        },
        moveMenuInDom() {
            if (this.open === true) {
                this.manipulateDOM('nav-mobile-container', 'nav-desktop-container')
                document.getElementById('html-body').classList.add('fixed-position')
                document.getElementById('nav-mobile-scroll').classList.add('mobile-scroll')
            } else {
                this.manipulateDOM('nav-desktop-container', 'nav-mobile-container')
                document.getElementById('html-body').classList.remove('fixed-position')
                document.getElementById('nav-mobile-scroll').classList.remove('mobile-scroll')
            }
        },
        manipulateDOM(to, from) {
            var NavElm = document.getElementById(to);
            if (NavElm.innerHTML.trim() == '') {
                let srcElm = document.getElementById(from);
                return new Promise((resolve, reject) => {
                    NavElm.append(...srcElm.childNodes);
                    return resolve();
                })
                    .then(() => {
                        Alpine.discoverUninitializedComponents(function (el) {
                            Alpine.initializeComponent(el)
                        })
                    });
            }
        }
    }
}

