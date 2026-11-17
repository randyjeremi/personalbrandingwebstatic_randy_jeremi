<?php

return [

    'title' => 'Blog',
    'label' => 'Blog · :count articles',
    'heading' => 'Notes,',
    'muted' => 'tips & stories.',
    'lead' => 'Writing about design, UI/UX, motion, AI, and experiences behind the scenes.',
    'back' => 'All articles',
    'read_time' => ':minutes min read',
    'newer' => 'Newer',
    'older' => 'Older',
    'other' => 'Other articles',
    'related_title' => 'Read',
    'related_muted' => 'next',
    'empty' => 'No articles yet.',

    'categories' => [
        'design' => 'Design',
        'experience' => 'Experience',
        'ai' => 'AI',
        'learning' => 'Learning',
        'tutorial' => 'Tutorial',
    ],

    'posts' => [
        'beautiful-mess-proses-desain' => [
            'title' => 'Beautiful Mess: Why a Messy Design Process Is Healthy',
            'excerpt' => 'Discarded sketches, piled-up layers, and endless revisions aren\'t signs of failure. They\'re proof that an idea is growing.',
            'content' => [
                ['type' => 'p', 'text' => 'If you opened my working files, you\'d see dozens of unused artboards, layers named "final-final-fix", and colors that changed three times. I used to be embarrassed by that. Now I see it as an important part of the process.'],
                ['type' => 'h2', 'text' => 'Messy at the start, tidy at the end'],
                ['type' => 'p', 'text' => 'The exploration phase is supposed to be wild. The goal isn\'t to make something good yet, but to find a direction. The more possibilities you try, the better your chances of finding a solution you didn\'t expect.'],
                ['type' => 'list', 'items' => ['Explore: make as many variations as possible without judging.', 'Curate: pick the 2–3 strongest directions.', 'Execute: refine the grid, typography, and details.', 'Systemize: document it so it can be reused.']],
                ['type' => 'h2', 'text' => 'What to keep in check'],
                ['type' => 'p', 'text' => 'Messy is fine, as long as it has a deadline. I usually set aside a fixed amount of time for exploration, then force myself into the curation stage. Without that limit, the creative process can turn into procrastination.'],
                ['type' => 'quote', 'text' => 'Beautiful mess = growth. Directed chaos is a sign that we\'re learning.'],
            ],
        ],
        'belakang-panggung-ideafest-sub-2026' => [
            'title' => 'Lessons from Behind the Scenes at IDEAfest SUB 2026',
            'excerpt' => 'Being a Technical Crew member at a large creative event taught me one thing: the small, invisible details decide everything.',
            'content' => [
                ['type' => 'p', 'text' => 'In August 2026, I joined IDEAfest SUB 2026 as a Technical Crew member. The job sounds simple: make sure everything technical runs. In reality, it was one of the most intense learning experiences I\'ve had.'],
                ['type' => 'h2', 'text' => 'Preparation is 80% of the work'],
                ['type' => 'p', 'text' => 'Before visitors arrived, we prepared equipment, checked venue readiness, and made sure every session had clear technical requirements. The tidier the preparation, the calmer the event.'],
                ['type' => 'h2', 'text' => 'Coordinating across teams'],
                ['type' => 'p', 'text' => 'The technical team doesn\'t work alone. We constantly coordinated with the event, creative, and production teams to stay on schedule. Short, clear communication turned out to be just as important as technical skills.'],
                ['type' => 'list', 'items' => ['Monitor technical conditions during live sessions.', 'Respond quickly to issues so the event isn\'t disrupted.', 'Note down problems for the next evaluation.']],
                ['type' => 'p', 'text' => 'At the end of the event, I received the Best Technical Crew award. To me, it\'s a reminder that behind-the-scenes work has a big impact too.'],
            ],
        ],
        'ai-di-proses-kreatif' => [
            'title' => 'Using AI in the Creative Process Without Losing Brand Identity',
            'excerpt' => 'AI can speed up visual production, but a brand still needs direction. Here\'s how I split the roles between machine and designer.',
            'content' => [
                ['type' => 'p', 'text' => 'Since working with ALVA Technology Resolution, I\'ve experimented a lot with bringing AI into my design workflow. The result is interesting: production is much faster, but a new challenge appears, which is keeping the brand consistent.'],
                ['type' => 'h2', 'text' => 'AI for exploration, humans for decisions'],
                ['type' => 'p', 'text' => 'I use AI in the early stages: finding variations of ideas, compositions, and visual moods. Once a direction is found, decisions about typography, color, and hierarchy are still made by hand.'],
                ['type' => 'h2', 'text' => 'Set up guardrails'],
                ['type' => 'list', 'items' => ['Prepare a simple brand guideline: colors, fonts, photo style.', 'Save prompts that work so results stay consistent.', 'Always edit AI output, never use it raw.', 'Check copyright and content appropriateness.']],
                ['type' => 'quote', 'text' => 'AI speeds up the hands; it doesn\'t replace the eyes.'],
                ['type' => 'p', 'text' => 'With roles divided like this, AI becomes a powerful production assistant while the brand identity stays intact.'],
            ],
        ],
        'dari-smk-ke-informatika' => [
            'title' => 'From SMK Telkom to Informatics: Notes on Learning UI/UX',
            'excerpt' => 'The journey from Software Engineering, a UI/UX bootcamp at Purwadhika, to studying Informatics, and what I learned at each station.',
            'content' => [
                ['type' => 'p', 'text' => 'I started in the Software Engineering program at SMK Telkom 1 Medan. There I learned programming logic, and discovered that I was more excited working on the visual side.'],
                ['type' => 'h2', 'text' => 'Station 1: competitions'],
                ['type' => 'p', 'text' => 'Competitions were the best training ground. First place in the North Sumatra provincial web design competition and third place in web development at I/O Fest 2023 taught me to work under deadlines and in a team.'],
                ['type' => 'h2', 'text' => 'Station 2: Purwadhika'],
                ['type' => 'p', 'text' => 'The Job Connector UI/UX program at Purwadhika opened my eyes to user research, wireframes, and how to present designs to others, not just make them look good.'],
                ['type' => 'h2', 'text' => 'Station 3: Informatics'],
                ['type' => 'p', 'text' => 'Now at Universitas Ciputra Surabaya, I\'m deepening the technical side again. Combining design and code lets me talk to both designers and developers.'],
                ['type' => 'list', 'items' => ['Start with small projects, but finish them.', 'Join competitions to train your mindset and speed.', 'Document the process, not just the final result.']],
            ],
        ],
        'efek-popcorn-after-effects' => [
            'title' => 'Quick Tutorial: The "Pop-Corn" Effect in After Effects',
            'excerpt' => 'Elements that "pop" one by one with a little bounce. A simple effect that instantly makes motion feel alive.',
            'content' => [
                ['type' => 'p', 'text' => 'The pop-corn effect is an animation where many small elements appear one after another like popping corn. The key is scale, random timing, and a bit of overshoot.'],
                ['type' => 'h2', 'text' => 'Basic steps'],
                ['type' => 'list', 'items' => ['Create the elements (circles, icons, or letters) on separate layers.', 'Animate Scale from 0% to 110%, then down to 100%.', 'Apply Easy Ease, then adjust the graph editor so it starts fast.', 'Offset each layer\'s keyframes randomly by a few frames.']],
                ['type' => 'h2', 'text' => 'Making it feel natural'],
                ['type' => 'p', 'text' => 'Add a little rotation and position movement as each element appears. These small variations make the animation feel organic instead of stiff.'],
                ['type' => 'quote', 'text' => 'A little overshoot is enough. Too much makes the motion feel cheap.'],
                ['type' => 'p', 'text' => 'I also used this effect on this website: watch how the colored round badges pop in with a slight bounce.'],
            ],
        ],
    ],

];
