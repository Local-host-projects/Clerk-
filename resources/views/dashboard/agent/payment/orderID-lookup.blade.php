<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal | Order Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #050505;
            --accent-glow: rgba(0, 255, 136, 0.15);
            --accent-solid: #00FF88;
            --border-color: #1a1a1a;
        }

        body {
            background-color: var(--bg-deep);
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .terminal-font {
            font-family: 'Space Mono', monospace;
        }

        /* Background grid effect */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        .main-card {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            width: 100%;
            max-width: 600px;
            padding: 60px 40px;
            border-radius: 24px;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-card.valid {
            border-color: var(--accent-solid);
            box-shadow: 0 0 40px var(--accent-glow);
        }

        .order-input {
            background: transparent;
            border: none;
            width: 100%;
            color: white;
            font-family: 'Space Mono', monospace;
            font-size: 32px;
            letter-spacing: 0.5em;
            text-align: center;
            outline: none;
            transition: color 0.3s;
        }

        .order-input::placeholder {
            color: #222;
        }

        .input-underline {
            height: 2px;
            background: #222;
            width: 100%;
            margin-top: 15px;
            position: relative;
            overflow: hidden;
        }

        .input-underline::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0%;
            background: var(--accent-solid);
            transition: width 0.3s ease;
            box-shadow: 0 0 10px var(--accent-solid);
        }

        .input-underline.valid::after {
            width: 100%;
        }

        .digit-box {
            display: inline-block;
            width: 30px;
            border-bottom: 2px solid #222;
            margin: 0 4px;
            height: 40px;
        }

        .btn-submit {
            width: 100%;
            padding: 20px;
            background: transparent;
            border: 1px solid #333;
            color: #666;
            border-radius: 12px;
            margin-top: 40px;
            font-weight: 600;
            letter-spacing: 2px;
            transition: all 0.3s;
            cursor: not-allowed;
            text-transform: uppercase;
        }

        .btn-submit.active {
            background: var(--accent-solid);
            color: #000;
            border-color: var(--accent-solid);
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 255, 136, 0.2);
        }

        .btn-submit.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 255, 136, 0.4);
        }

        /* Subtle animated scanline */
        .scan {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent-glow), transparent);
            animation: moveScan 3s linear infinite;
            opacity: 0.5;
        }

        @keyframes moveScan {
            0% { top: 0; }
            100% { top: 100%; }
        }

        .status-badge {
            background: rgba(255,255,255,0.05);
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .logo-mark {
            width: 40px;
            height: 40px;
            border: 2px solid var(--accent-solid);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 0 15px var(--accent-glow);
        }
    </style>
</head>
<body>

    <div class="grid-overlay"></div>

    <div class="main-card" id="card">
        <div class="scan"></div>
        
        <div class="flex flex-col items-center">
            <div class="logo-mark">
            
                
                <div class="w-4 h-4 bg-[#00FF88] rounded-sm animate-pulse"></div>
            </div>
            
            <h1 class="text-2xl font-semibold mb-2">ENTER THE CUSTOMER'S ORDER-ID</h1>
            <p class="text-zinc-500 text-sm mb-12 text-center max-w-[300px]">
                Entering the unique order-id would help you find the order and complete purchase.
            </p>
            <form action="{{route('agent.payment.confirm')}}">
            <div class="w-full relative px-10">
                <input 
                    type="text" 
                    id="order-input" 
                    name="order_id" 
                    class="order-input" 
                    placeholder="••••••••••••" 
                    maxlength="12"
                    autocomplete="off"
                    spellcheck="false"
                >
                <div class="input-underline" id="underline"></div>
                
                <div class="flex justify-between mt-6 px-2">
                    <span id="char-count" class="terminal-font text-[10px] text-zinc-600"><b>Clerk</b>||<b>Agent</b></span>
                    <span id="status-text" class="terminal-font text-[10px] text-zinc-600 uppercase">Awaiting key...</span>
                </div>
            </div>

            <button id="submit-btn" class="btn-submit terminal-font">
                Unlock Manifest
            </button>
            </form>

            <div class="mt-12 flex gap-4">
                <div class="status-badge text-zinc-400">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span> System Online
                </div>
                <div class="status-badge text-zinc-400">
                    Agent Account
                </div>
            </div>
        </div>
    </div>

    <script>
        const input = document.getElementById('order-input');
        const underline = document.getElementById('underline');
        const countDisplay = document.getElementById('char-count');
        const statusText = document.getElementById('status-text');
        const btn = document.getElementById('submit-btn');
        const card = document.getElementById('card');

        input.addEventListener('input', (e) => {
            // Only allow numbers and letters
            let val = e.target.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
            e.target.value = val;

            const length = val.length;
            countDisplay.innerText = `BLOCK_ID: ${length}/12`;

            // Dynamic Styling
            if (length === 12) {
                underline.classList.add('valid');
                btn.classList.add('active');
                card.classList.add('valid');
                statusText.innerText = 'Key Validated';
                statusText.style.color = '#00FF88';
                btn.innerText = 'Access Authorized';
            } else {
                underline.classList.remove('valid');
                btn.classList.remove('active');
                card.classList.remove('valid');
                statusText.innerText = length > 0 ? 'Entering Key...' : 'Awaiting key...';
                statusText.style.color = '#525252';
                btn.innerText = 'Unlock Manifest';
            }
        });

        // Focus input on load
        window.onload = () => input.focus();

        // Optional: Trigger effect on button click
        btn.addEventListener('click', () => {
            if (btn.classList.contains('active')) {
                btn.innerText = 'Initializing...';
                btn.style.opacity = '0.7';
                setTimeout(() => {
                    // Logic for redirection or order fetching would go here
                    alert("Order ID " + input.value + " submitted.");
                    btn.innerText = 'Access Authorized';
                    btn.style.opacity = '1';
                }, 1500);
            }
        });
    </script>
</body>
</html>