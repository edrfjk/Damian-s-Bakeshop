@extends('layouts.app')
@section('title', 'Contact Us — Damian Bakeshop')

@section('content')

<!-- Hero -->
<section class="py-24 text-center relative overflow-hidden" style="background: linear-gradient(135deg, #3d1f0a, #6b3a1f);">
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <span class="text-[400px]">📞</span>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden-light);">Get in Touch</p>
        <h1 class="font-display text-5xl font-bold text-white mb-6">Contact Us</h1>
        <p class="text-white/70 text-lg">We love hearing from you — orders, questions, or just to say hi!</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" style="fill: var(--warm-cream);"><path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z"/></svg>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Contact Info -->
        <div class="space-y-6 animate-slide-up">
            <div>
                <p class="script-font text-2xl mb-2" style="color: var(--golden);">Reach Out</p>
                <h2 class="font-display text-4xl font-bold mb-4" style="color: var(--chocolate);">We're Here for You</h2>
                <span class="gold-line-left"></span>
                <p class="leading-relaxed mt-4" style="color: var(--chocolate-light);">Whether you want to place a custom cake order, ask about our menu, or just share how much you loved your last visit — we'd love to hear from you!</p>
            </div>

            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-2xl" style="background: rgba(200,134,10,0.12);">📍</div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Visit the Bakeshop</h4>
                    <p style="color: var(--chocolate-light);">123 Quezon Ave, San Fernando, La Union 2500</p>
                    <a href="https://maps.google.com/?q=San+Fernando+La+Union+Philippines" target="_blank" class="text-sm font-semibold mt-1 inline-block hover:underline" style="color: var(--golden);">Get Directions →</a>
                </div>
            </div>

            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-2xl" style="background: rgba(200,134,10,0.12);">📞</div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Call or Text</h4>
                    <p style="color: var(--chocolate-light);">+63 912 345 6789</p>
                    <p class="text-xs mt-1" style="color: var(--golden);">Available Mon–Sat 7am–7pm</p>
                </div>
            </div>

            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-2xl" style="background: rgba(200,134,10,0.12);">✉️</div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Email Us</h4>
                    <p style="color: var(--chocolate-light);">hello@damianbakeshop.com</p>
                    <p class="text-xs mt-1" style="color: var(--golden);">We reply within 24 hours</p>
                </div>
            </div>

            <!-- Map -->
            <div class="card overflow-hidden rounded-2xl">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30729.31!2d120.3170!3d16.6158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3391a4af95b5d28b%3A0x6b2fc7dea8b25c9b!2sSan%20Fernando%2C%20La%20Union!5e0!3m2!1sen!2sph!4v1700000000000"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Custom Order Form -->
        <div class="animate-slide-up stagger-2">
            <div class="card p-8">
                <h3 class="font-display text-2xl font-bold mb-2" style="color: var(--chocolate);">Send Us a Message</h3>
                <p class="text-sm mb-6" style="color: var(--chocolate-light);">For custom cake orders, bulk orders, or any inquiries</p>

                @if(session('contact_success'))
                    <div class="mb-6 p-4 rounded-xl border-l-4 text-sm" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
                        ✅ Message sent! We'll get back to you soon.
                    </div>
                @endif

                <form class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">First Name</label>
                            <input type="text" class="input" placeholder="Juan">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Last Name</label>
                            <input type="text" class="input" placeholder="dela Cruz">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Email</label>
                        <input type="email" class="input" placeholder="your@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Phone</label>
                        <input type="tel" class="input" placeholder="+63 912 345 6789">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Type of Inquiry</label>
                        <select class="input">
                            <option value="">Select an option...</option>
                            <option>Custom Cake Order</option>
                            <option>Bulk / Corporate Order</option>
                            <option>General Question</option>
                            <option>Delivery Inquiry</option>
                            <option>Feedback / Compliment</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Message</label>
                        <textarea class="input resize-none" rows="5" placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-full py-4">
                        📩 Send Message
                    </button>
                </form>
            </div>

            <!-- Hours reminder -->
            <div class="card p-6 mt-6" style="background: linear-gradient(135deg, rgba(200,134,10,0.06), rgba(200,134,10,0.02)); border: 1px solid rgba(200,134,10,0.15);">
                <h4 class="font-display font-bold text-lg mb-4" style="color: var(--chocolate);">🕐 Store Hours</h4>
                <div class="space-y-2 text-sm" style="color: var(--chocolate-light);">
                    <div class="flex justify-between"><span>Monday – Friday</span><span class="font-bold" style="color: var(--chocolate);">6:00 AM – 8:00 PM</span></div>
                    <div class="flex justify-between"><span>Saturday</span><span class="font-bold" style="color: var(--chocolate);">6:00 AM – 9:00 PM</span></div>
                    <div class="flex justify-between"><span>Sunday</span><span class="font-bold" style="color: var(--chocolate);">7:00 AM – 6:00 PM</span></div>
                </div>
                <p class="text-xs mt-4 p-3 rounded-xl font-semibold" style="background: rgba(200,134,10,0.1); color: var(--golden-dark);">
                    🎂 Custom cakes require at least 3 days advance notice. Call or message us to discuss!
                </p>
            </div>
        </div>
    </div>
</div>
@endsection