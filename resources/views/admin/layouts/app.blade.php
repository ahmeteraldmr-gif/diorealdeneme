<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">
<head>
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/png" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('foto.img/logo_dioreal.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yönetim Paneli') — Dioreal Dijital</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Premium Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/admin-new.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">

    <script>
        function doToggleSidebar(e) {
            if (e) {
                if (e.preventDefault) e.preventDefault();
                if (e.stopPropagation) e.stopPropagation();
            }
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            if (!sidebar) return;

            var isClosed = !sidebar.classList.contains('mobile-active');

            if (isClosed) {
                sidebar.classList.add('mobile-active');
                sidebar.style.cssText = 'transform: translateX(0px) !important; left: 0px !important; display: flex !important; flex-direction: column !important; z-index: 9999999 !important; position: fixed !important; top: 0 !important; bottom: 0 !important; width: 280px !important; background: #0f172a !important; box-shadow: 10px 0 30px rgba(0,0,0,0.8) !important; visibility: visible !important; opacity: 1 !important;';
                if (overlay) {
                    overlay.style.cssText = 'display: block !important; opacity: 1 !important; z-index: 9999998 !important; position: fixed !important; inset: 0 !important; background: rgba(0,0,0,0.75) !important; backdrop-filter: blur(4px) !important;';
                }
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.remove('mobile-active');
                sidebar.style.cssText = 'transform: translateX(-100%) !important; position: fixed !important; top: 0 !important; bottom: 0 !important; left: 0 !important; width: 280px !important; z-index: 9999999 !important;';
                if (overlay) {
                    overlay.style.cssText = 'display: none !important; opacity: 0 !important;';
                }
                document.body.style.overflow = '';
            }
        }
        window.toggleSidebar = doToggleSidebar;

        function switchLanguageTab(lang) {
            var tabs = document.querySelectorAll('.lang-tab');
            tabs.forEach(function(tab) {
                var tabLang = tab.getAttribute('data-lang') || (tab.getAttribute('onclick') && tab.getAttribute('onclick').includes('en') ? 'en' : 'tr');
                if (tabLang === lang) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });

            var panes = document.querySelectorAll('.lang-pane');
            panes.forEach(function(pane) {
                var paneLang = pane.getAttribute('data-lang');
                if (paneLang === lang) {
                    pane.classList.add('active');
                    pane.style.setProperty('display', 'block', 'important');
                } else {
                    pane.classList.remove('active');
                    pane.style.setProperty('display', 'none', 'important');
                }
            });
        }
        window.switchLanguageTab = switchLanguageTab;
        window.switchTab = switchLanguageTab;
        window.switchLang = switchLanguageTab;
    </script>
</head>

<body>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="doToggleSidebar(event)" ontouchstart="doToggleSidebar(event)"></div>


    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-brand">
            DIOREAL<span>.</span>
        </div>

        <div class="sidebar-menu-wrapper" id="sidebarMenuWrapper">
            <ul class="sidebar-menu" id="sidebarMenu">
                <li class="sidebar-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-pie"></i> Kontrol Paneli
                    </a>
                </li>
                @adminCan('hotels')
                <li class="sidebar-item {{ Request::routeIs('admin.hotels.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.hotels.index') }}">
                        <i class="fas fa-hotel"></i> Oteller
                    </a>
                </li>
                @endadminCan
                @adminCan('restaurants')
                <li class="sidebar-item {{ Request::routeIs('admin.restaurants.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.restaurants.index') }}">
                        <i class="fas fa-utensils"></i> Restoranlar
                    </a>
                </li>
                @endadminCan
                @adminCan('yachts')
                <li class="sidebar-item {{ Request::routeIs('admin.yachts.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.yachts.index') }}">
                        <i class="fas fa-ship"></i> Yatlar
                    </a>
                </li>
                @endadminCan
                @adminCan('guides')
                <li class="sidebar-item {{ Request::routeIs('admin.guides.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.guides.index') }}">
                        <i class="fas fa-map-marked-alt"></i> Destinasyon Rehberleri
                    </a>
                </li>
                @endadminCan
                @adminCan('events')
                <li class="sidebar-item {{ Request::routeIs('admin.events.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.events.index') }}">
                        <i class="fas fa-calendar-alt"></i> Etkinlikler
                    </a>
                </li>
                @endadminCan
                @adminCan('journals')
                <li class="sidebar-item {{ Request::routeIs('admin.journals.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.journals.index') }}">
                        <i class="fas fa-newspaper"></i> Journal
                    </a>
                </li>
                @endadminCan
                @adminCan('destinations')
                <li class="sidebar-item {{ Request::routeIs('admin.destinations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.destinations.index') }}">
                        <i class="fas fa-map-signs"></i> Destinasyonlar
                    </a>
                </li>
                @endadminCan
                
                <li class="sidebar-item {{ Request::routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fas fa-box-open"></i> Ürünler & Paketler
                    </a>
                </li>
                <li class="sidebar-item" style="padding-left: 1.2rem; font-size: 0.85rem; opacity: 0.9;">
                    <a href="{{ route('admin.products.index') }}#showcase-banner-settings" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                        <i class="fas fa-images"></i> ↳ Vitrin Görselleri & Metinler
                    </a>
                </li>
                <li class="sidebar-item {{ Request::routeIs('admin.categories.*') ? 'active' : '' }}" style="padding-left: 1.2rem; font-size: 0.85rem; opacity: 0.9;">
                    <a href="{{ route('admin.categories.index') }}" style="padding-top: 0.3rem; padding-bottom: 0.3rem;">
                        <i class="fas fa-tags"></i> ↳ Ürün Kategorileri
                    </a>
                </li>


                @adminCan('users')
                <li class="sidebar-item {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users-cog"></i> Kullanıcılar & Yetkiler
                    </a>
                </li>
                @endadminCan
                @adminCan('settings')
                <li class="sidebar-item">
                    <a href="{{ route('admin.settings.index') }}#tab-pages">
                        <i class="fas fa-images"></i> Sayfa Kapakları & Metinler
                    </a>
                </li>
                <li class="sidebar-item {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-sliders-h"></i> Hakkımızda & Genel Ayarlar
                    </a>
                </li>
                @endadminCan

            </ul>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Güvenli Çıkış
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Container -->
    <main class="admin-main">
        
        <header class="admin-header">
            <div class="header-left">
                <button type="button" class="sidebar-toggle" id="sidebarToggle" onclick="doToggleSidebar(event)" ontouchstart="doToggleSidebar(event)">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="header-title-wrapper">
                    <h1 class="admin-title">@yield('page_title')</h1>
                    <p class="admin-subtitle">@yield('page_subtitle', 'Dioreal Dijital portal yönetimi')</p>
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-outline" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
                </a>
            </div>
        </header>

        <!-- Flash Notifications -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content -->
        @yield('content')
        
    </main>

    <!-- Global Admin Scripts -->
    <script>
        function toggleSidebar(e) {
            if (e && e.preventDefault) e.preventDefault();
            if (e && e.stopPropagation) e.stopPropagation();

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (!sidebar) return;

            const isCurrentlyOpen = sidebar.classList.contains('open') || sidebar.style.transform === 'translateX(0px)';

            if (isCurrentlyOpen) {
                sidebar.classList.remove('open');
                sidebar.style.setProperty('transform', 'translateX(-100%)', 'important');
                if (overlay) {
                    overlay.classList.remove('active');
                    overlay.style.setProperty('display', 'none', 'important');
                    overlay.style.setProperty('opacity', '0', 'important');
                }
                document.body.style.overflow = '';
            } else {
                sidebar.classList.add('open');
                sidebar.style.setProperty('transform', 'translateX(0px)', 'important');
                sidebar.style.setProperty('display', 'flex', 'important');
                sidebar.style.setProperty('z-index', '999999', 'important');
                if (overlay) {
                    overlay.classList.add('active');
                    overlay.style.setProperty('display', 'block', 'important');
                    overlay.style.setProperty('opacity', '1', 'important');
                    overlay.style.setProperty('z-index', '999998', 'important');
                }
                document.body.style.overflow = 'hidden';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('sidebarToggle');
            if (btn) {
                btn.addEventListener('click', toggleSidebar);
                btn.addEventListener('touchstart', toggleSidebar, {passive: false});
            }
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
                overlay.addEventListener('touchstart', toggleSidebar, {passive: false});
            }
        });

        // Close sidebar on window resize above tablet breakpoint
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                const sidebar = document.getElementById('sidebar');

                const overlay = document.getElementById('sidebarOverlay');
                if (sidebar) {
                    sidebar.classList.remove('open');
                    sidebar.setAttribute('style', '');
                }
                if (overlay) {
                    overlay.classList.remove('active');
                    overlay.setAttribute('style', '');
                }
                document.body.style.overflow = '';
            }
        });

        // Language tab switching helper
        function switchLanguageTab(lang) {
            // Toggle active tabs
            document.querySelectorAll('.lang-tab').forEach(tab => {
                if (tab.dataset.lang === lang) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            // Toggle active panes
            document.querySelectorAll('.lang-pane').forEach(pane => {
                if (pane.dataset.lang === lang) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });
        }

        // ── Client-side file size guard (max 50 MB per file) ──
        const MAX_FILE_MB = 50;
        const MAX_FILE_BYTES = MAX_FILE_MB * 1024 * 1024;

        document.addEventListener('change', function (e) {
            if (e.target && e.target.type === 'file') {
                const files = Array.from(e.target.files);
                const oversized = files.filter(f => f.size > MAX_FILE_BYTES);
                if (oversized.length > 0) {
                    const names = oversized.map(f => `"${f.name}" (${(f.size / 1024 / 1024).toFixed(1)} MB)`).join(', ');
                    alert(`⚠️ Dosya boyutu sınırı aşıldı!\n\n${names}\n\nMaksimum dosya boyutu: ${MAX_FILE_MB} MB\nLütfen daha küçük bir görsel seçin veya görseli sıkıştırın.`);
                    e.target.value = '';
                }
            }
        });

        // Block form submit if any file input has oversized files
        document.addEventListener('submit', function (e) {
            const fileInputs = e.target.querySelectorAll('input[type="file"]');
            for (const input of fileInputs) {
                const files = Array.from(input.files || []);
                const oversized = files.filter(f => f.size > MAX_FILE_BYTES);
                if (oversized.length > 0) {
                    e.preventDefault();
                    alert(`⚠️ Yüklemek istediğiniz görsel ${MAX_FILE_MB} MB limitini aşıyor. Lütfen görseli sıkıştırın.`);
                    return false;
                }
            }
        });

        // ── Drag & Drop File Upload Zone Auto-Decorator ──
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("input[type='file']").forEach(input => {
                // Ignore inputs inside sortable gallery items
                if (input.closest(".gallery-item")) return;
                
                // Create a dropzone wrapper
                const dropzone = document.createElement("div");
                dropzone.className = "file-dropzone";
                dropzone.style.marginBottom = "1rem";
                
                const isMultiple = input.multiple;
                const accept = input.accept || "*";
                let typeText = "resim veya video";
                let iconClass = "fa-cloud-upload-alt";
                
                if (accept.includes("image")) {
                    typeText = "görsel";
                    iconClass = "fa-image";
                } else if (accept.includes("video")) {
                    typeText = "video";
                    iconClass = "fa-video";
                }
                
                dropzone.innerHTML = `
                    <i class="fas ${iconClass} dropzone-icon"></i>
                    <div class="dropzone-text">
                        ${isMultiple ? 'Dosyaları' : 'Dosyayı'} buraya sürükleyin veya <span>seçin</span>
                    </div>
                `;
                
                // Insert dropzone before input, then move input inside it
                input.parentNode.insertBefore(dropzone, input);
                dropzone.appendChild(input);
                
                // Find and hide old buttons that trigger this input click
                const allButtons = document.querySelectorAll("button, a.btn");
                allButtons.forEach(btn => {
                    const onclickAttr = btn.getAttribute("onclick");
                    if (onclickAttr && onclickAttr.includes(input.id) && onclickAttr.includes(".click()")) {
                        btn.style.display = "none";
                    }
                });
                
                // Click events
                dropzone.addEventListener("click", function (e) {
                    if (e.target !== input) {
                        input.click();
                    }
                });
                
                // Drag & drop events
                dropzone.addEventListener("dragover", function (e) {
                    e.preventDefault();
                    dropzone.classList.add("dragover");
                });
                
                dropzone.addEventListener("dragleave", function () {
                    dropzone.classList.remove("dragover");
                });
                
                dropzone.addEventListener("drop", function (e) {
                    e.preventDefault();
                    dropzone.classList.remove("dragover");
                    
                    if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                        input.files = e.dataTransfer.files;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        function scrollSidebar(amount) {
            const wrapper = document.getElementById('sidebarMenuWrapper');
            if (wrapper) {
                wrapper.scrollBy({ top: amount, behavior: 'smooth' });
            }
        }
    </script>
</body>
</html>
