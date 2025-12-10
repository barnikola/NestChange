<?php
$pageTitle = 'NestChange - Chat';
$activeNav = 'chat';
$bodyClass = 'chat-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Chat'],
];

ob_start();
?>
<main class="chat-content-wrapper">
    <div class="chat-layout">
        <aside class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div>
                    <p class="chat-sidebar-eyebrow">Chats</p>
                    <h2 class="chat-sidebar-title">Stay on top of every exchange.</h2>
                </div>
            </div>

            <label class="chat-search">
                <span class="chat-search-icon">🔍</span>
                <input type="text" placeholder="Search by user or listing">
            </label>

            <div class="chat-thread-list">
                <div class="chat-thread active">
                    <div class="chat-thread-avatar">LA</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Lena Antoniou</p>
                            <span class="chat-thread-time">9:14 AM</span>
                        </div>
                        <p class="chat-thread-subtitle">House exchange in Athens</p>
                    </div>
                </div>

                <div class="chat-thread">
                    <div class="chat-thread-avatar">JL</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Julien Lefèvre</p>
                            <span class="chat-thread-time">Yesterday</span>
                        </div>
                        <p class="chat-thread-subtitle">Sunny Lisbon Loft</p>
                    </div>
                </div>

                <div class="chat-thread">
                    <div class="chat-thread-avatar">MC</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Mei Chen</p>
                            <span class="chat-thread-time">Tue</span>
                        </div>
                        <p class="chat-thread-subtitle">Montreal Townhouse</p>
                    </div>
                </div>

                <div class="chat-thread">
                    <div class="chat-thread-avatar">SR</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Sven Richter</p>
                            <span class="chat-thread-time">Sep 24</span>
                        </div>
                        <p class="chat-thread-subtitle">Berlin Studio Retreat</p>
                    </div>
                </div>

                <div class="chat-thread">
                    <div class="chat-thread-avatar">AP</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Amelia Park</p>
                            <span class="chat-thread-time">Sep 19</span>
                        </div>
                        <p class="chat-thread-subtitle">Canal view stay</p>
                    </div>
                </div>

                <div class="chat-thread">
                    <div class="chat-thread-avatar support">S</div>
                    <div class="chat-thread-body">
                        <div class="chat-thread-row">
                            <p class="chat-thread-name">Support</p>
                            <span class="chat-thread-time">Sep 19</span>
                        </div>
                        <p class="chat-thread-subtitle">Onboarding team</p>
                    </div>
                </div>
            </div>
        </aside>

        <section class="chat-panel">
            <header class="chat-panel-header">
                <div class="chat-panel-participant">
                    <div class="chat-thread-avatar large">LA</div>
                    <div>
                        <h3 class="chat-panel-name">Lena Antoniou</h3>
                        <p class="chat-panel-meta">House exchange in Athens · 12–18 Aug 2025</p>
                    </div>
                </div>
                <div class="chat-panel-actions">
                    <button class="chat-panel-btn">View listing</button>
                    <button class="chat-panel-btn">View exchange details</button>
                </div>
            </header>

            <div class="chat-status-pill">Host accepted the exchange</div>

            <div class="chat-messages">
                <div class="chat-message outgoing">
                    <p>Vestibulum facilisis quam sed nulla faucibus, quis fringilla orci aliquet.</p>
                    <span class="chat-message-time">9:12 AM</span>
                </div>
                <div class="chat-message incoming">
                    <p>Curabitur vulputate sapien id erat imperdiet, eu egestas ex pulvinar.</p>
                    <span class="chat-message-time">9:20 AM</span>
                </div>
                <div class="chat-message outgoing">
                    <p>Etiam ornare tellus eget felis ultricies, vel dictum eros ullamcorper.</p>
                    <span class="chat-message-time">9:23 AM</span>
                </div>
                <div class="chat-message outgoing">
                    <p>Donec laoreet risus non sem gravida, sit amet consequat nisi vestibulum.</p>
                    <span class="chat-message-time">9:24 AM</span>
                </div>
            </div>

            <div class="chat-action-card">
                <div class="chat-action-content">
                    <p class="chat-action-eyebrow">Action required</p>
                    <h4 class="chat-action-title">Agree to exchange?</h4>
                    <p class="chat-action-text">
                        Confirm you're ready to finalize the exchange with Lena's family.
                    </p>
                </div>
                <div class="chat-action-buttons">
                    <button class="chat-action-btn primary">Agree</button>
                    <button class="chat-action-btn ghost">Decline</button>
                </div>
            </div>

            <div class="chat-composer">
                <div class="chat-composer-actions">
                    <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                    <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                </div>
                <input type="text" placeholder="Write a message..." class="chat-composer-input">
                <button class="chat-send-btn">Send</button>
            </div>
        </section>
    </div>
</main>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
