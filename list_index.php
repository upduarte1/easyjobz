<?php

require_once 'includes/db.php';
require_once 'includes/ads.php';
require_once 'templates/header.php';

$currentUserId = $_SESSION['user_id'] ?? null;
$ads = getTwoAds($currentUserId);
?>

<body class="home">
    <header>
        <div class="hero-text">
            <h2>Connecting People with Services</h2>
            <p>Find or offer household services in your area with ease.</p>
            <a href="list_create_ad.php" class="cta-button">Post an Ad</a>
        </div>

        <div class="slider">
            <div class="slide">
            </div>
            <div class="slide">
            </div>
            <div class="slide">
            </div>
            <div class="slide">
            </div>
        </div>
        <a href="#featured-ads" class="scroll-arrow">↓</a>
    </header>

    <main>
        <section id="featured-ads">
        <h2>Featured Ads</h2>
        <div class="ads">
            <?php if (!empty($ads)) : ?>
                <?php foreach ($ads as $ad) : ?>
                    <div class="ad-card">
                        <div class="ad-details">
                            <h3><?php echo htmlspecialchars($ad['title']); ?></h3>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($ad['description']); ?></p>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($ad['location']); ?></p>
                            <p><strong>Price:</strong> $<?php echo htmlspecialchars($ad['service_price']); ?></p>
                            <p><strong>Date Published:</strong> <?php echo htmlspecialchars($ad['date_published']); ?></p>
                        </div>
                        <div class="ad-card-creator">
                        <img src="<?php echo htmlspecialchars($ad['profile_photo'] ?? 'uploads/default_profile.png') ; ?>" alt="Profile Picture" class="profile-picture">                        <a href="list_view_profile.php?user_id=<?php echo $ad['publisher']; ?>" class="user-name">
                                <?php echo htmlspecialchars($ad['creator_name']); ?>
                            </a>
                            <a href="<?php echo isset($_SESSION['user_id']) ? 'list_browse_ads.php?tab=available' : 'login.php'; ?>" class="button contact-button">
                                Contact Now
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No ads available at the moment. Please check back later.</p>
            <?php endif; ?>
        </div>
    </section>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>