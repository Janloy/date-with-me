<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Will You Go Out With Me? 💖</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>
<body>

    <div id="splash-overlay" class="splash-screen">
        <div class="splash-card">
            <div class="splash-emoji">💌</div>
            <h2>You have received a special message!</h2>
            <p class="sub-text">Click below to open it...</p>
            <button id="open-btn" class="btn btn-yes">Open Invitation ✨</button>
        </div>
    </div>

    <div class="music-control" id="music-toggle" title="Toggle Music">🔊</div>
    <audio id="bg-music" loop src="assets/music/Heartopia.mp3"></audio>

    <audio id="sfx-hover" src="https://assets.mixkit.co/active_storage/sfx/2568/2568-84.wav" preload="auto"></audio>
    <audio id="sfx-yes" src="https://assets.mixkit.co/active_storage/sfx/2019/2019-84.wav" preload="auto"></audio>
    <audio id="sfx-success" src="https://assets.mixkit.co/active_storage/sfx/1435/1435-84.wav" preload="auto"></audio>

    <div class="container">
        <div id="proposal-card" class="card">
            <div class="card-emoji">🥺👉👈</div>
            <h2>Will you go out with me?</h2>
            <p class="sub-text">Think carefully! Choose your destiny...</p>
            <div class="btn-group">
                <button id="yes-btn" class="btn btn-yes">YES! 💖</button>
                <button id="no-btn" class="btn btn-no">No 💔</button>
            </div>
        </div>

        <div id="planner-card" class="card">
            <h2>Yay! Let's Plan It Out 🌸</h2>
            <p class="sub-text">Customize our perfect hangout date below</p>
            <form id="date-planner-form">
                <div class="form-group">
                    <label>Pick a Vibe ✨</label>
                    <select name="vibe" id="vibe-select" required>
                        <option value="Cozy & Casual">Cozy & Casual ☕</option>
                        <option value="Fancy Dinner">Fancy Dinner 🍷</option>
                        <option value="Adventure/Outdoor">Adventure / Outdoor 🌲</option>
                        <option value="Arcade & Fun">Arcade & Fun 🕹️</option>
                        <option value="Surprise Me 🎁">Surprise Me 🎁</option>
                    </select>
                </div>

                <div class="dress-badge" id="dress-badge">👔 Dress Code: Nice & Comfy 👟</div>

                <div class="form-group">
                    <label>What are we eating? 🍔</label>
                    <select name="food" id="food-select" required>
                        <option value="Jollibee / Fast Food">Bida ang Saya! (Jollibee / McDo / KFC) 🍗🍟</option>
                        <option value="Wings">Unlimited Wings 🔥</option>
                        <option value="Sizzling / Kanin-All-You-Can">Sizzling Sisig + Rice (Mang Inasal / Local Sizzling) 🍛</option>
                        <option value="Coffee & Pastries">Cafe Date ✨☕🥐</option>
                        <option value="Milk Tea & Street Food">Milk Tea + Tusok-Tusok Street Food 🧋🍢</option>
                        <option value="Fancy Restaurant / Buffet">Fancy Dinner Date 🍷</option>
                        <option value="Surprise Me 🎁">Surprise Me (Ikaw Lang Bahala) 🎁</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>When are you free? 📅</label>
                    <input type="datetime-local" name="date_time" id="date_time_input" required>
                </div>

                <button type="submit" class="btn btn-submit">Lock it in! 🔒</button>
            </form>
        </div>

        <div id="success-card" class="card">
            <div class="success-icon">🎉🥳</div>
            <h2>It's an Absolute Date!</h2>
            <p class="sub-text">Your preferences have been safely locked down.</p>
            
            <div class="countdown-container">
                <h3>Counting down the seconds...</h3>
                <div id="countdown-timer">00d 00h 00m 00s</div>
            </div>

            <a href="#" id="calendar-link" target="_blank" class="btn btn-calendar">📅 Add to Google Calendar</a>
        </div>
    </div>

    <script src="assets/app.js"></script>
</body>
</html>