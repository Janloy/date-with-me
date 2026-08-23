document.addEventListener("DOMContentLoaded", () => {
    const splashOverlay = document.getElementById("splash-overlay");
    const openBtn = document.getElementById("open-btn");
    const noBtn = document.getElementById("no-btn");
    const yesBtn = document.getElementById("yes-btn");
    const proposalCard = document.getElementById("proposal-card");
    const plannerCard = document.getElementById("planner-card");
    const successCard = document.getElementById("success-card");
    const plannerForm = document.getElementById("date-planner-form");
    const vibeSelect = document.getElementById("vibe-select");
    const foodSelect = document.getElementById("food-select");
    const dressBadge = document.getElementById("dress-badge");
    const musicToggle = document.getElementById("music-toggle");
    const bgMusic = document.getElementById("bg-music");
    const calendarLink = document.getElementById("calendar-link");

    // Interactive Sound FX Variables
    const sfxHover = document.getElementById("sfx-hover");
    const sfxYes = document.getElementById("sfx-yes");
    const sfxSuccess = document.getElementById("sfx-success");

    let yesScale = 1;
    let noClicksCount = 0;
    let countdownInterval;

    const guiltTripTexts = [
        "No 💔",
        "Are you sure? 🥺",
        "Think of the food! 🍕",
        "Just click YES already! 😂",
        "You can't escape! ✨"
    ];

    // Splash Open Trigger: Unlocks audio permissions completely
    openBtn.addEventListener("click", () => {
        splashOverlay.style.opacity = "0";
        setTimeout(() => {
            splashOverlay.style.display = "none";
            proposalCard.classList.add("active");
        }, 400);

        bgMusic.play().then(() => {
            musicToggle.innerText = "🔊";
        }).catch(err => console.log("Audio block error:", err));
    });

    // Background Audio Manual Toggle
    musicToggle.addEventListener("click", (e) => {
        e.stopPropagation();
        if (bgMusic.paused) {
            bgMusic.play();
            musicToggle.innerText = "🔊";
        } else {
            bgMusic.pause();
            musicToggle.innerText = "🎵";
        }
    });

    // Dynamic Floating Particles Generator
    function createHeartParticles() {
        const emojis = ['💖', '❤️', '🌸', '✨', '💕'];
        setInterval(() => {
            const heart = document.createElement("div");
            heart.classList.add("heart-particle");
            heart.innerText = emojis[Math.floor(Math.random() * emojis.length)];
            heart.style.left = Math.random() * 100 + "vw";
            heart.style.animationDuration = Math.random() * 3 + 4 + "s";
            heart.style.fontSize = Math.random() * 15 + 15 + "px";
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 6000);
        }, 500);
    }
    createHeartParticles();

    // High-Performance Viewport-Locked Evasive Positioning System
    function escapeNoButton(e) {
        if(e) e.preventDefault();

        // Play pop/bubble hover dodge chime
        if (sfxHover) {
            sfxHover.currentTime = 0;
            sfxHover.play().catch(() => {});
        }

        // Force strict fixed rendering context
        noBtn.style.position = 'fixed';
        noBtn.classList.add("running");
        
        // Kunin ang eksaktong sukat ng No button ngayon
        const buttonWidth = noBtn.offsetWidth || 120;
        const buttonHeight = noBtn.offsetHeight || 45;

        // Kunin ang eksaktong sukat ng VISIBLE screen lamang nang walang scrollable dimensions
        const viewWidth = document.documentElement.clientWidth;
        const viewHeight = document.documentElement.clientHeight;

        // Maglaan ng safety padding para hindi dumikit sa pinaka-gilid ng screen boundary
        const padding = 30;

        // Siguraduhin na hindi lalagpas sa visible edges ng screen ang max boundaries
        const maxX = viewWidth - buttonWidth - padding;
        const maxY = viewHeight - buttonHeight - padding;
        
        // Mag-generate ng random spot sa loob lang ng safe visible boundaries
        const randomX = Math.max(padding, Math.floor(Math.random() * maxX));
        const randomY = Math.max(padding, Math.floor(Math.random() * maxY));
        
        noBtn.style.left = `${randomX}px`;
        noBtn.style.top = `${randomY}px`;

        // Palakihin ang YES button sequential scaling limits
        yesScale += 0.15;
        yesBtn.style.transform = `scale(${yesScale})`;

        noClicksCount++;
        noBtn.innerText = guiltTripTexts[noClicksCount % guiltTripTexts.length];
    }

    // Intercept triggers to instantly displace element layout bounds
    noBtn.addEventListener("mouseenter", escapeNoButton);
    noBtn.addEventListener("mouseover", escapeNoButton);
    noBtn.addEventListener("mousemove", escapeNoButton);
    
    noBtn.addEventListener("click", (e) => {
        e.preventDefault();
        escapeNoButton(e);
    });
    noBtn.addEventListener("touchstart", (e) => {
        e.preventDefault();
        escapeNoButton(e);
    });

    yesBtn.addEventListener("click", () => {
        if (sfxYes) {
            sfxYes.currentTime = 0;
            sfxYes.play().catch(() => {});
        }

        if (typeof confetti === "function") {
            confetti({ particleCount: 50, spread: 60, origin: { y: 0.8 } });
        }
        proposalCard.classList.remove("active");
        setTimeout(() => plannerCard.classList.add("active"), 200);
    });

    // Localized Dynamic Dress Code Engine
    function updateDressCode() {
        const vibe = vibeSelect.value;
        const food = foodSelect.value;

        if (vibe === "Fancy Dinner" || food === "Fancy Restaurant / Buffet") {
            dressBadge.innerText = "👗✨ Dress Code: Elegant, Smart Casual, or Semi-Formal";
        } else if (vibe === "Adventure/Outdoor" || food === "Milk Tea & Street Food") {
            dressBadge.innerText = "👟🎒 Dress Code: Comfy Clothes + Porma Sneakers";
        } else if (food === "Wings") {
            dressBadge.innerText = "👕 Sando or Loose Shirt (Ready mahumod sa unli sauce) 🍗";
        } else if (food === "Jollibee / Fast Food") {
            dressBadge.innerText = "🧢👕 Casual/Chill Tambay Outfit";
        } else {
            dressBadge.innerText = "👔 Dress Code: Nice & Comfy 👟";
        }
    }

    vibeSelect.addEventListener("change", updateDressCode);
    foodSelect.addEventListener("change", updateDressCode);

    // Handle AJAX submittal and full viewport confetti presentation
    plannerForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(plannerForm);

        fetch("submit_response.php", { method: "POST", body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                plannerCard.classList.remove("active");
                setTimeout(() => {
                    successCard.classList.add("active");
                    
                    if (sfxSuccess) {
                        sfxSuccess.currentTime = 0;
                        sfxSuccess.play().catch(() => {});
                    }

                    if (typeof confetti === "function") {
                        confetti({ particleCount: 180, spread: 90, scalar: 1.2 });
                    }
                    
                    const timeVal = document.getElementById("date_time_input").value;
                    startCountdown(timeVal);
                    setupGoogleCalendarLink(timeVal, formData.get('vibe'), formData.get('food'));
                }, 200);
            } else {
                alert("Something went wrong. Please check your data fields!");
            }
        });
    });

    function startCountdown(targetDateTime) {
        const target = new Date(targetDateTime).getTime();
        clearInterval(countdownInterval);
        countdownInterval = setInterval(() => {
            const now = new Date().getTime();
            const diff = target - now;

            if (diff < 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown-timer").innerText = "It's Date Time! Enjoy! 💕";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById("countdown-timer").innerText = `${days}d ${hours}h ${mins}m ${secs}s`;
        }, 1000);
    }

    function setupGoogleCalendarLink(dateTime, vibe, food) {
        const start = new Date(dateTime).toISOString().replace(/-|:|\.\d\d\d/g, "");
        const end = new Date(new Date(dateTime).getTime() + 2*60*60*1000).toISOString().replace(/-|:|\.\d\d\d/g, "");
        const title = encodeURIComponent("Our Special Date! 💖");
        const details = encodeURIComponent(`Vibe chosen: ${vibe}\nFood option chosen: ${food}\nLocked-in via Sweetheart Planner app!`);
        
        calendarLink.href = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&dates=${start}/${end}&details=${details}`;
    }
});