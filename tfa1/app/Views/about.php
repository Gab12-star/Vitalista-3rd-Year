<?= $this->include('partials/nav') ?>

<main class="dashboard">
    <header class="topbar">
        <div>
            <p class="eyebrow">SYSTEM INFORMATION</p>
            <h1>About Pointify POS</h1>
        </div>
    </header>

    <section class="about-layout">
        <div class="about-intro">
            <span class="big-icon">ⓘ</span>
            <h2>Basic Point-of-Sale System</h2>
            <p>
                This is the first version of a Point-of-Sale website developed
                using the CodeIgniter 4 framework.
            </p>
        </div>

        <div class="about-list">
            <div>
                <span>01</span>
                <p><strong>Landing Page</strong>Dashboard overview of the POS system.</p>
            </div>

            <div>
                <span>02</span>
                <p><strong>Customer Accounts</strong>Displays full name, email, and phone number.</p>
            </div>

            <div>
                <span>03</span>
                <p><strong>User Accounts</strong>Displays username, full name, and staff role.</p>
            </div>

            <div>
                <span>04</span>
                <p><strong>Temporary Data</strong>Uses static PHP arrays without a database.</p>
            </div>
        </div>
    </section>
</main>