import './bootstrap';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

document.addEventListener('livewire:navigated', () => {
    // Trigger any global animations or refresh scroll trigger when navigating
    ScrollTrigger.refresh();

    // Example fade-in for elements with .gsap-fade-in class
    const fadeInElements = document.querySelectorAll('.gsap-fade-in');
    if (fadeInElements.length > 0) {
        gsap.fromTo('.gsap-fade-in',
            { autoAlpha: 0, y: 30 },
            {
                autoAlpha: 1, y: 0, duration: 1, stagger: 0.1, scrollTrigger: {
                    trigger: '.gsap-fade-in',
                    start: 'top 80%',
                }
            }
        );
    }
});
