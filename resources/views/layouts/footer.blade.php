<footer style="background: var(--chocolate);" class="text-white mt-20">

    <!-- Top wave -->
    <div class="overflow-hidden leading-none -mb-1">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" style="fill: var(--warm-cream);">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,0 L0,0 Z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Brand -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg,#c8860a,#e8a020);">
                        <span class="text-3xl">🍞</span>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-xl text-white leading-tight">Damian Bakeshop</h3>
                        <span class="script-font text-sm" style="color: var(--golden-light);">Handcrafted with Love</span>
                    </div>
                </div>
                <p class="text-white/60 text-sm leading-relaxed mb-5">
                    Since 2010, Damian Bakeshop has been serving La Union's finest handcrafted pastries, breads, and cakes — baked fresh every morning.
                </p>
                <!-- Social icons -->
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition" style="background: rgba(200,134,10,0.3);">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition" style="background: rgba(200,134,10,0.3);">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-display font-bold text-lg text-white mb-5">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-white/60 hover:text-golden-light transition text-sm">Home</a></li>
                    <li><a href="{{ route('customer.products') }}" class="text-white/60 hover:text-golden-light transition text-sm">Our Menu</a></li>
                    <li><a href="{{ route('about') }}" class="text-white/60 hover:text-golden-light transition text-sm">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/60 hover:text-golden-light transition text-sm">Contact</a></li>
                    @guest
                        <li><a href="{{ route('register') }}" class="text-white/60 hover:text-golden-light transition text-sm">Create Account</a></li>
                    @endguest
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="font-display font-bold text-lg text-white mb-5">Visit Us</h4>
                <ul class="space-y-3 text-sm text-white/60">
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: var(--golden-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>123 Quezon Ave, San Fernando, La Union, Philippines 2500</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: var(--golden-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>+63 912 345 6789</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: var(--golden-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>hello@damianbakeshop.com</span>
                    </li>
                </ul>
            </div>

            <!-- Hours -->
            <div>
                <h4 class="font-display font-bold text-lg text-white mb-5">Store Hours</h4>
                <ul class="space-y-2 text-sm text-white/60">
                    <li class="flex justify-between"><span>Monday – Friday</span><span class="text-white font-semibold">6am – 8pm</span></li>
                    <li class="flex justify-between"><span>Saturday</span><span class="text-white font-semibold">6am – 9pm</span></li>
                    <li class="flex justify-between"><span>Sunday</span><span class="text-white font-semibold">7am – 6pm</span></li>
                </ul>
                <div class="mt-5 p-3 rounded-xl" style="background: rgba(200,134,10,0.15); border: 1px solid rgba(200,134,10,0.2);">
                    <p class="text-xs font-semibold" style="color: var(--golden-light);">🎂 Custom cake orders accepted 3 days in advance</p>
                </div>
            </div>
        </div>

        <div class="border-t mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4" style="border-color: rgba(255,255,255,0.1);">
            <p class="text-white/40 text-sm">© {{ date('Y') }} Damian Bakeshop. All rights reserved.</p>
            <p class="text-white/40 text-sm flex items-center gap-1">Made with <span class="text-rose-DEFAULT">❤</span> in La Union, Philippines</p>
        </div>
    </div>
</footer>