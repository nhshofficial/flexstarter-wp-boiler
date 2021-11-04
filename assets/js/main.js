// Navigation
let header = document.querySelector('#header')
let lastLi = document.querySelector('.navbar > ul > li:last-child')
// console.log(header.offsetHeight)

let navbar = document.querySelector('.navbar-menu') // menu ul
navbar.style.top = `${header.offsetHeight}px` // get and apply height

let navToggle = document.querySelector('#nav-toggle') // mobile toggle button
let hiddenCls = document.querySelector('.hidden') // mobile toggle button

navToggle.addEventListener('click', () => {

    navbar.classList.toggle('animated_menu');
    
    if(hiddenCls.style.opacity == '1'){
        navbar.style.cssText += 'display: none !important; opacity: 0; height: 0; z-index: inherit;'
        // hiddenCls.style.cssText += 'transition-timing-function:linear, step-end'
    } else {
        navbar.style.cssText += 'display: block !important; opacity: 1; height: auto; z-index: 999;'
        // hiddenCls.style.removeProperty('transition-timing-function')
    }
}, true);


let hasChildren = document.querySelector('ul.navbar-menu > li.menu-item-has-children');
let subMenuHack1 = document.querySelector('.navbar-menu > li.menu-item-has-children > ul');
let subMenuHack2 = document.querySelector('.navbar-menu > li:focus-within > ul');
let navbarUl = document.querySelector('.navbar-menu ul');
hasChildren.addEventListener('click', () => {
    if(navbarUl.style.opacity == '1'){
        subMenuHack1.style.cssText += 'display: none !important; opacity: 0;';
        // subMenuHack2.style.cssText += 'display: none !important; opacity: 0;';
    } else {
        subMenuHack1.style.cssText += 'display: block !important; opacity: 1;';
        // subMenuHack2.style.cssText += 'display: block !important; opacity: 1;';
    }
}, true);

(function ($) {
	"use strict";

    jQuery(document).ready(function($){


        $(".embed-responsive iframe").addClass("embed-responsive-item");
        $(".carousel-inner .item:first-child").addClass("active");


    }); // end 


    jQuery(window).load(function(){

        jQuery(".industry-slide-preloader, .preloader-circle-wrapper").fadeOut(500);
        jQuery(".preloader, .spinner").delay(500).fadeOut(500);

    }); // end


}(jQuery));	