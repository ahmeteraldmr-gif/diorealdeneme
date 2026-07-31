/**
 * Dioreal Luxury Cart Management Script
 */
(function () {
    'use strict';

    const CART_STORAGE_KEY = 'dioreal_cart_items';

    // Default sample luxury items to populate initially if cart is empty
    const DEFAULT_SAMPLE_ITEMS = [
        {
            id: 'hotel-1',
            type: 'Oteller',
            name: 'Mandarin Oriental Bodrum — Sea View Villa',
            price: 24500,
            quantity: 1,
            image: '/foto.img/hero_4k.jpg',
            details: '2 Gece, 2 Yetişkin • Kahvaltı Dahil'
        },
        {
            id: 'yacht-1',
            type: 'Yatlar',
            name: 'Aegean Princess Motor Yacht Charter',
            price: 42000,
            quantity: 1,
            image: '/foto.img/hero_slide_2.jpg',
            details: 'Günlük Tur • Göcek Koyları Özel Mürettebat'
        },
        {
            id: 'restaurant-1',
            type: 'Restoranlar',
            name: 'Lucca Beach Bodrum — VIP Table Booking',
            price: 6500,
            quantity: 2,
            image: '/foto.img/hero_slide_3.jpg',
            details: 'Sunset Dinner • Özel Şarap Eşleşmeli Tadım'
        }
    ];

    let appliedDiscountPercent = 0;

    // Helper to format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('tr-TR', {
            style: 'currency',
            currency: 'TRY',
            maximumFractionDigits: 0
        }).format(amount);
    }

    // Get Cart Items
    function getCart() {
        const stored = localStorage.getItem(CART_STORAGE_KEY);
        if (!stored) {
            // First time initialization with sample data
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(DEFAULT_SAMPLE_ITEMS));
            return DEFAULT_SAMPLE_ITEMS;
        }
        try {
            return JSON.parse(stored);
        } catch (e) {
            console.error('Error parsing cart from localStorage', e);
            return [];
        }
    }

    // Save Cart Items
    function saveCart(cart) {
        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        updateBadge();
        renderCart();
    }

    // Update Badge Counters across header
    function updateBadge() {
        const cart = getCart();
        const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);

        const badges = document.querySelectorAll('.cart-badge');
        badges.forEach(badge => {
            badge.textContent = totalCount;
            if (totalCount > 0) {
                badge.style.display = 'flex';
                badge.classList.add('bump');
                setTimeout(() => badge.classList.remove('bump'), 300);
            } else {
                badge.style.display = 'none';
            }
        });
    }

    // Render Cart Page Elements
    function renderCart() {
        const itemsListEl = document.getElementById('cartItemsList');
        const emptyStateEl = document.getElementById('emptyCartState');
        const summaryCardEl = document.getElementById('summaryCard');

        if (!itemsListEl) return; // Not on sepet page

        const cart = getCart();

        if (!cart || cart.length === 0) {
            itemsListEl.style.display = 'none';
            if (summaryCardEl) summaryCardEl.style.display = 'none';
            if (emptyStateEl) emptyStateEl.style.display = 'block';
            return;
        }

        itemsListEl.style.display = 'flex';
        if (summaryCardEl) summaryCardEl.style.display = 'block';
        if (emptyStateEl) emptyStateEl.style.display = 'none';

        // Render Item HTML
        itemsListEl.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-left-block">
                    <div class="cart-item-img-wrap">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-img" onerror="this.src='/foto.img/hero_4k.jpg'">
                    </div>
                    <div class="cart-item-details">
                        <span class="cart-item-tag">${item.type || 'Lüks Koleksiyon'}</span>
                        <a href="#" class="cart-item-name">${item.name}</a>
                        <span class="cart-item-price-unit">${item.details || ''} • ₺${item.price.toLocaleString('tr-TR')}</span>
                    </div>
                </div>

                <div class="cart-item-right-block">
                    <div class="quantity-control">
                        <button type="button" class="qty-btn btn-minus" data-id="${item.id}">-</button>
                        <span class="qty-val">${item.quantity}</span>
                        <button type="button" class="qty-btn btn-plus" data-id="${item.id}">+</button>
                    </div>

                    <div class="cart-item-subtotal">₺${(item.price * item.quantity).toLocaleString('tr-TR')}</div>

                    <button type="button" class="remove-btn" data-id="${item.id}" title="Ürünü Kaldır">
                        <i class="fa-regular fa-trash-can" style="font-size: 1rem;"></i>
                        <span>Sil</span>
                    </button>
                </div>
            </div>
        `).join('');

        // Recalculate totals
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discountAmount = subtotal * (appliedDiscountPercent / 100);
        const serviceFee = subtotal > 0 ? subtotal * 0.08 : 0; // 8% luxury service fee
        const grandTotal = subtotal - discountAmount + serviceFee;

        // Update Summary Elements
        const subtotalEl = document.getElementById('cartSubtotal');
        const discountEl = document.getElementById('cartDiscount');
        const discountRowEl = document.getElementById('discountRow');
        const serviceFeeEl = document.getElementById('cartServiceFee');
        const grandTotalEl = document.getElementById('cartGrandTotal');

        if (subtotalEl) subtotalEl.textContent = formatCurrency(subtotal);
        if (serviceFeeEl) serviceFeeEl.textContent = formatCurrency(serviceFee);
        if (grandTotalEl) grandTotalEl.textContent = formatCurrency(grandTotal);

        if (discountEl && discountRowEl) {
            if (appliedDiscountPercent > 0) {
                discountRowEl.style.display = 'flex';
                discountEl.textContent = `-${formatCurrency(discountAmount)} (%${appliedDiscountPercent})`;
            } else {
                discountRowEl.style.display = 'none';
            }
        }

        attachItemEvents();
    }

    // Attach Event Listeners to cart buttons
    function attachItemEvents() {
        // Plus buttons
        document.querySelectorAll('.btn-plus').forEach(btn => {
            btn.onclick = function () {
                const id = this.getAttribute('data-id');
                changeQuantity(id, 1);
            };
        });

        // Minus buttons
        document.querySelectorAll('.btn-minus').forEach(btn => {
            btn.onclick = function () {
                const id = this.getAttribute('data-id');
                changeQuantity(id, -1);
            };
        });

        // Remove buttons
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.onclick = function () {
                const id = this.getAttribute('data-id');
                removeItem(id);
            };
        });
    }

    function changeQuantity(id, delta) {
        let cart = getCart();
        const itemIndex = cart.findIndex(i => i.id === id);
        if (itemIndex > -1) {
            cart[itemIndex].quantity += delta;
            if (cart[itemIndex].quantity <= 0) {
                cart.splice(itemIndex, 1);
            }
            saveCart(cart);
        }
    }

    function removeItem(id) {
        let cart = getCart();
        cart = cart.filter(i => i.id !== id);
        saveCart(cart);
    }

    // Promo Code Handler
    function initPromoCode() {
        const promoBtn = document.getElementById('applyPromoBtn');
        const promoInput = document.getElementById('promoInput');
        const promoMsg = document.getElementById('promoMsg');

        if (!promoBtn || !promoInput) return;

        promoBtn.addEventListener('click', function () {
            const code = promoInput.value.trim().toUpperCase();
            if (code === 'DIOREAL10' || code === 'LUXURY10') {
                appliedDiscountPercent = 10;
                if (promoMsg) {
                    promoMsg.style.color = '#4caf50';
                    promoMsg.textContent = '%10 Lüks İndirim Kuponu Uygulandı!';
                }
                renderCart();
            } else if (code === 'DIOREAL20' || code === 'VIP20') {
                appliedDiscountPercent = 20;
                if (promoMsg) {
                    promoMsg.style.color = '#4caf50';
                    promoMsg.textContent = '%20 VIP İndirim Kuponu Uygulandı!';
                }
                renderCart();
            } else if (code === '') {
                appliedDiscountPercent = 0;
                if (promoMsg) promoMsg.textContent = '';
                renderCart();
            } else {
                if (promoMsg) {
                    promoMsg.style.color = '#ff5252';
                    promoMsg.textContent = 'Geçersiz promosyon kodu.';
                }
      // Checkout Button Handler - Direct E-Commerce Credit Card Integration
    function initCheckout() {
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (!checkoutBtn) return;

        checkoutBtn.addEventListener('click', function () {
            const cart = getCart();
            if (!cart || cart.length === 0) {
                const isEn = (document.documentElement.lang === 'en');
                alert(isEn ? 'Your cart is empty!' : 'Sepetiniz henüz boş!');
                return;
            }

            // Open Credit Card Payment Modal
            openCreditCardModal();
        });
    }

    function openCreditCardModal() {
        const modal = document.getElementById('creditCardModal');
        if (modal) {
            modal.classList.add('active');
            // Update total in modal
            const cart = getCart();
            const rawSubtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const discountAmount = rawSubtotal * (appliedDiscountPercent / 100);
            const serviceFee = rawSubtotal * 0.08;
            const grandTotal = rawSubtotal - discountAmount + serviceFee;

            const modalTotalEl = document.getElementById('modalPayAmount');
            if (modalTotalEl) {
                modalTotalEl.textContent = formatCurrency(grandTotal);
            }
        }
    }

    window.closeCreditCardModal = function() {
        const modal = document.getElementById('creditCardModal');
        if (modal) modal.classList.remove('active');
    };

    // Format credit card input numbers
    window.formatCardNumber = function(input) {
        let value = input.value.replace(/\D/g, '');
        value = value.substring(0, 16);
        let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
        input.value = formatted;
    };

    // Process Credit Card Payment (Simulated 3D Secure Approval)
    window.processCreditCardPayment = function(event) {
        event.preventDefault();
        const cardName = document.getElementById('cardName').value;
        const cardNumber = document.getElementById('cardNumber').value;
        const cardExp = document.getElementById('cardExp').value;
        const cardCvc = document.getElementById('cardCvc').value;

        if (!cardName || !cardNumber || !cardExp || !cardCvc) {
            alert('Lütfen kart üzerindeki tüm alanları doldurun.');
            return;
        }

        const payBtn = document.getElementById('paySubmitBtn');
        if (payBtn) {
            payBtn.disabled = true;
            payBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> 3D SECURE DOĞRULANIYOR...';
        }

        setTimeout(() => {
            closeCreditCardModal();
            if (payBtn) {
                payBtn.disabled = false;
                payBtn.innerHTML = '<span>ÖDEMEYİ TAMAMLA</span>';
            }
            showOrderSuccessModal();
        }, 2000);
    };

    function showOrderSuccessModal() {
        const cart = getCart();
        const orderCode = 'DIO-' + Math.floor(100000 + Math.random() * 900000);
        
        const rawSubtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discountAmount = rawSubtotal * (appliedDiscountPercent / 100);
        const serviceFee = rawSubtotal * 0.08;
        const grandTotal = rawSubtotal - discountAmount + serviceFee;

        const orderCodeEl = document.getElementById('successOrderCode');
        const orderTotalEl = document.getElementById('successOrderTotal');
        const successModal = document.getElementById('orderSuccessModal');

        if (orderCodeEl) orderCodeEl.textContent = orderCode;
        if (orderTotalEl) orderTotalEl.textContent = formatCurrency(grandTotal);

        if (successModal) {
            successModal.classList.add('active');
        }

        // Clear cart after successful purchase
        localStorage.removeItem(CART_STORAGE_KEY);
        updateBadge();
        renderCart();
    }

    window.closeOrderSuccessModal = function() {
        const successModal = document.getElementById('orderSuccessModal');
        if (successModal) successModal.classList.remove('active');
        window.location.href = '/urunler';
    };

    // Export window cart helper
    window.DiorealCart = {
        addItem: function (item) {
            let cart = getCart();
            const existing = cart.find(i => i.id === item.id);
            if (existing) {
                existing.quantity += item.quantity || 1;
            } else {
                cart.push({
                    id: item.id || 'item-' + Date.now(),
                    type: item.type || 'Deneyim',
                    name: item.name,
                    price: item.price || 0,
                    quantity: item.quantity || 1,
                    image: item.image || '/foto.img/hero_4k.jpg',
                    details: item.details || ''
                });
            }
            saveCart(cart);
        },
        getCart: getCart,
        updateBadge: updateBadge
    };

    // Initialize on DOM Ready
    document.addEventListener('DOMContentLoaded', function () {
        updateBadge();
        renderCart();
        initPromoCode();
        initCheckout();
    });
})();

