<div class="header-container">
    <div class="header">
        <div class="header-wrapper">
            <div class="header-left">
                
                <div class="mobile-menu-button">
                    <button class="hamburger-btn" aria-label="Toggle mobile menu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            
                <div class="logo-section">
                    <a href="{{ url('/') }}">
                        <img src="/front/images/logo.png" alt="Obecno Logo" class="header-logo">
                    </a>
                </div>
            </div>
            
            <div class="header-center">
                <nav class="navigation-menu">
                    <div class="menu-item">
                        <span class="menu-text">Home</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-text">Features</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-text">Pricing</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-text">About</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-text">Contact</span>
                    </div>
                    <div class="menu-item active" onclick="window.location='{{ url('/dashboard') }}'">
                        <span class="menu-text">My Account</span>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu">
        <div class="mobile-menu-header">
            
            <button class="mobile-menu-close" aria-label="Close mobile menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="mobile-navigation">
            
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">Home</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">Features</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">Pricings</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">About</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">Contact</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item active">
                <span class="mobile-menu-text">My Account</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
        </nav>
    </div>
</div>