<?php

/**
 * Long-form SEO guides for /stack/{slug} pages.
 * Keys must match skill slugs in config/portfolio.php.
 */
return [
    'php' => [
        'eyebrow' => 'PHP guide',
        'title' => 'PHP: language, frameworks, and how to build with it',
        'subtitle' => 'A practical PHP developer guide covering core concepts, popular frameworks like Laravel, and how I use PHP for web apps and APIs in production.',
        'seo_title' => 'PHP Developer Guide — Language, Laravel & Frameworks | Madhusudan Timalsina',
        'seo_description' => 'Learn PHP for web development: what PHP is, core concepts, Laravel and other PHP frameworks, when to use PHP, and real PHP projects by a developer in Lalitpur, Nepal.',
        'h1' => 'PHP developer guide',
        'cta_label' => 'Hire a PHP developer',
        'intro' => 'PHP is a widely used server-side language for building websites, web applications, and REST APIs. From content-driven sites to Laravel products with authentication and databases, PHP remains a strong choice for shipping reliable backend features quickly.',
        'sections' => [
            [
                'heading' => 'What is PHP?',
                'body' => [
                    'PHP (Hypertext Preprocessor) runs on the server and generates HTML, JSON, or other responses for browsers and mobile apps. It powers a large share of the web, including WordPress, Laravel applications, and custom business systems.',
                    'You write PHP scripts or framework code, the server executes it, talks to a database when needed, and returns a response. That simple request–response model makes PHP approachable for beginners and productive for experienced developers.',
                ],
            ],
            [
                'heading' => 'What you can build with PHP',
                'body' => [
                    'Common PHP use cases include business websites, admin dashboards, e-commerce catalogs, booking systems, REST APIs for React or mobile clients, authentication and user management, and integrations with payment or email providers.',
                    'In my work I use PHP (especially with Laravel) for production features at Smart Sarks, freelance delivery, and academic products — including database design, CRUD modules, and API endpoints.',
                ],
            ],
            [
                'heading' => 'Core PHP concepts to learn first',
                'bullets' => [
                    'Syntax basics: variables, arrays, loops, functions, and conditionals',
                    'HTTP request/response, forms, sessions, and cookies',
                    'Object-oriented PHP: classes, namespaces, and autoloading',
                    'Composer for packages and dependency management',
                    'Talking to MySQL or PostgreSQL with safe queries (prepared statements)',
                    'Error handling, validation, and basic security (XSS, CSRF, SQL injection)',
                    'Structuring a project so routes, logic, and views stay maintainable',
                ],
            ],
            [
                'heading' => 'Popular PHP frameworks',
                'body' => [
                    'Frameworks give you routing, databases, authentication, and structure so you do not rebuild everything from scratch. Here is how the main options compare when you are choosing a PHP stack.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Laravel',
                        'slug' => 'laravel',
                        'level' => 'My primary PHP framework',
                        'desc' => 'Elegant syntax, Eloquent ORM, Blade/Inertia/Livewire options, queues, mail, and strong ecosystem. Ideal for custom web apps, APIs, dashboards, and e-commerce-style products.',
                    ],
                    [
                        'name' => 'Symfony',
                        'slug' => null,
                        'level' => 'Enterprise components',
                        'desc' => 'Component-based and battle-tested. Many Laravel internals build on Symfony packages. Great when you need fine-grained control or large modular systems.',
                    ],
                    [
                        'name' => 'CodeIgniter',
                        'slug' => null,
                        'level' => 'Lightweight MVC',
                        'desc' => 'Small footprint and easy to start. Useful for simpler apps or shared-hosting environments where a full Laravel stack is more than you need.',
                    ],
                    [
                        'name' => 'Slim / microframeworks',
                        'slug' => null,
                        'level' => 'APIs & microservices',
                        'desc' => 'Minimal routing and middleware for focused APIs or microservices when you want PHP without a full-stack framework.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: how to practice PHP well',
                'bullets' => [
                    'Build small end-to-end apps (CRUD + auth) instead of only watching tutorials',
                    'Use Composer and follow PSR coding standards early',
                    'Prefer prepared statements / ORM queries — never concatenate raw SQL from user input',
                    'Separate concerns: routing, business logic, and presentation',
                    'Add tests (PHPUnit or Pest) for critical flows once the app takes shape',
                    'Deploy something real so you learn environment config and debugging',
                ],
            ],
            [
                'heading' => 'When PHP is a good fit',
                'body' => [
                    'Choose PHP when you need a proven server-side language for websites and APIs, strong hosting support, a large talent pool, or frameworks like Laravel that speed up delivery. It pairs well with MySQL/PostgreSQL and with JavaScript frontends via REST APIs.',
                    'If you are hiring for PHP or Laravel work in Nepal or remote, I am available for selective freelance and product collaboration alongside my role at Smart Sarks.',
                ],
            ],
        ],
        'related_skills' => ['laravel', 'mysql', 'postgresql', 'rest-api', 'sanctum', 'livewire', 'phpunit'],
        'faqs' => [
            [
                'question' => 'What is PHP used for in web development?',
                'answer' => 'PHP is used to build server-side websites, web applications, admin panels, e-commerce systems, and REST APIs. It handles requests, business logic, database access, and responses for browsers or mobile apps.',
            ],
            [
                'question' => 'Which PHP framework should beginners learn?',
                'answer' => 'After learning basic PHP, Laravel is the most practical framework for most new projects. It has clear documentation, a large community, and tools for auth, databases, queues, and APIs.',
            ],
            [
                'question' => 'Is PHP still worth learning in 2026?',
                'answer' => 'Yes. PHP powers a huge portion of the web, Laravel keeps the ecosystem modern, and many companies need PHP developers for APIs, CMS-related work, and custom business apps.',
            ],
            [
                'question' => 'Do you take freelance PHP or Laravel projects?',
                'answer' => 'Yes — selective freelance PHP and Laravel work for features, APIs, database design, and focused UI support. Contact me via the hire form, email, or LinkedIn.',
            ],
        ],
    ],

    'nodejs' => [
        'eyebrow' => 'Node.js guide',
        'title' => 'Node.js: JavaScript on the server for APIs and real-time apps',
        'subtitle' => 'A practical Node.js developer guide — runtime basics, Express and NestJS frameworks, PostgreSQL integration, and how I build backend services with Node.',
        'seo_title' => 'Node.js Developer Guide — Express, NestJS & APIs | Madhusudan Timalsina',
        'seo_description' => 'Learn Node.js for backend development: what Node is, core concepts, Express and NestJS frameworks, databases like PostgreSQL, and API guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'Node.js developer guide',
        'cta_label' => 'Hire a Node.js developer',
        'intro' => 'Node.js lets you run JavaScript on the server. It is a strong fit for REST APIs, real-time features, tooling, and full-stack JS products where the same language spans browser and backend. I use Node.js alongside Laravel when projects need flexible API services or JavaScript-heavy backends.',
        'sections' => [
            [
                'heading' => 'What is Node.js?',
                'body' => [
                    'Node.js is a JavaScript runtime built on Chrome’s V8 engine. Instead of running in the browser, your code runs on the server and can handle HTTP requests, file I/O, databases, and background jobs.',
                    'Its event-driven, non-blocking model works well for I/O-heavy apps: APIs, websockets, microservices, and CLI tools. With npm you get a huge package ecosystem for almost every integration.',
                ],
            ],
            [
                'heading' => 'What you can build with Node.js',
                'body' => [
                    'Typical Node projects include JSON REST APIs for React/Vue/mobile clients, authentication services, webhooks and integrations, real-time chat or notifications, SSR apps (Next.js API routes / custom servers), and automation scripts.',
                    'In portfolio and freelance work I reach for Node when the team already thinks in JavaScript/TypeScript, or when a lightweight API service sits beside a Laravel or Python app.',
                ],
            ],
            [
                'heading' => 'Core Node.js concepts to learn first',
                'bullets' => [
                    'Modules (CommonJS / ESM), npm/pnpm, and package.json scripts',
                    'Async patterns: callbacks → promises → async/await',
                    'Creating an HTTP server and understanding the request/response cycle',
                    'Environment variables, config, and 12-factor style secrets',
                    'Connecting to PostgreSQL or MongoDB safely',
                    'Middleware, routing, and error handling patterns',
                    'Basic security: validation, rate limits, helmet headers, JWT/session auth',
                ],
            ],
            [
                'heading' => 'Popular Node.js frameworks',
                'body' => [
                    'You rarely build production APIs with raw http alone. These frameworks are the usual next step after core Node.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Express.js',
                        'slug' => 'express',
                        'level' => 'Minimal & flexible',
                        'desc' => 'The classic Node web framework. Fast to learn, huge middleware ecosystem, perfect for REST APIs and small-to-medium services.',
                    ],
                    [
                        'name' => 'NestJS',
                        'slug' => 'nestjs',
                        'level' => 'Structured TypeScript',
                        'desc' => 'Opinionated, Angular-inspired architecture with modules, DI, and first-class TypeScript. Ideal when teams want clear structure at scale.',
                    ],
                    [
                        'name' => 'Fastify',
                        'slug' => null,
                        'level' => 'Performance-focused',
                        'desc' => 'High-throughput alternative to Express with a strong plugin model and schema-based validation.',
                    ],
                    [
                        'name' => 'Next.js API / Edge',
                        'slug' => 'nextjs',
                        'level' => 'Full-stack JS',
                        'desc' => 'Route handlers and server actions in a React app when backend and frontend live in one product.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: practicing Node.js well',
                'bullets' => [
                    'Build a small CRUD API with auth before jumping into microservices',
                    'Prefer TypeScript once you are comfortable with JS async basics',
                    'Use a router framework (Express/Nest) instead of reinventing middleware',
                    'Validate all input and never trust client-sent IDs or roles',
                    'Log errors centrally and return consistent API error shapes',
                    'Pair Node APIs with PostgreSQL for relational data you will query seriously',
                ],
            ],
            [
                'heading' => 'When Node.js is a good fit',
                'body' => [
                    'Choose Node when your product is JavaScript/TypeScript end-to-end, you need realtime or streaming features, or you want a lightweight API layer. It also shines for tooling and developer platforms.',
                    'I am open to selective Node.js API and backend work — contact me if you need Express/Nest services, auth, or PostgreSQL-backed endpoints.',
                ],
            ],
        ],
        'related_skills' => ['express', 'nestjs', 'javascript', 'typescript', 'postgresql', 'mongodb', 'rest-api', 'jwt'],
        'faqs' => [
            [
                'question' => 'What is Node.js used for?',
                'answer' => 'Node.js is used for server-side JavaScript: REST APIs, realtime apps, microservices, CLI tools, and full-stack JavaScript products that share language with the frontend.',
            ],
            [
                'question' => 'Should I learn Express or NestJS first?',
                'answer' => 'Learn Express first to understand routing and middleware. Move to NestJS when you want stronger structure, TypeScript modules, and patterns that scale with a team.',
            ],
            [
                'question' => 'Is Node.js good with PostgreSQL?',
                'answer' => 'Yes. Node pairs well with PostgreSQL via drivers or ORMs (Prisma, TypeORM, Knex). Relational schemas stay clear while your API stays in JavaScript/TypeScript.',
            ],
            [
                'question' => 'Do you build Node.js backends for hire?',
                'answer' => 'Yes — selective freelance Node.js API and service work, including Express, auth, and database integration. Reach out via the contact page or LinkedIn.',
            ],
        ],
    ],

    'express' => [
        'eyebrow' => 'Express.js guide',
        'title' => 'Express.js: fast Node.js APIs and middleware',
        'subtitle' => 'How Express works, when to use it, routing and middleware guidance, and how it fits with Node.js, NestJS, and PostgreSQL in real projects.',
        'seo_title' => 'Express.js Developer Guide — Node.js APIs & Middleware | Madhusudan Timalsina',
        'seo_description' => 'Learn Express.js for Node.js web APIs: routing, middleware, auth patterns, PostgreSQL, and practical guidance from a web developer in Lalitpur, Nepal.',
        'h1' => 'Express.js developer guide',
        'cta_label' => 'Hire an Express.js developer',
        'intro' => 'Express.js is the most widely used web framework for Node.js. It keeps the surface area small — routes, middleware, and request handlers — so you can ship REST APIs and HTTP services quickly without a heavy framework lock-in.',
        'sections' => [
            [
                'heading' => 'What is Express.js?',
                'body' => [
                    'Express is a minimal Node.js framework that wraps HTTP with a clean API: define routes, chain middleware, parse bodies, and send responses. It does not force an ORM or folder structure, which makes it flexible for APIs, BFF layers, and prototypes.',
                    'Most Node developers learn Express early because so many tutorials, starters, and production services still use it — and NestJS itself can sit on Express under the hood.',
                ],
            ],
            [
                'heading' => 'What you can build with Express',
                'body' => [
                    'CRUD REST APIs, authentication endpoints, file upload services, webhooks, admin JSON backends, and gateway/BFF layers in front of other microservices.',
                    'I use Express when a project needs a focused Node API without Nest’s ceremony — especially for smaller services or learning/demo APIs that still follow solid middleware patterns.',
                ],
            ],
            [
                'heading' => 'Core Express concepts',
                'bullets' => [
                    'app.get/post/put/delete and Router for modular routes',
                    'Middleware order: logging → auth → validation → handler → error handler',
                    'req / res / next and async error propagation',
                    'Body parsers, CORS, helmet, and compression',
                    'Serving static files vs pure JSON APIs',
                    'Structuring controllers/services as the app grows',
                    'Connecting Express to PostgreSQL or MongoDB',
                ],
            ],
            [
                'heading' => 'Express vs other Node frameworks',
                'body' => [
                    'Pick Express for speed and flexibility. Move toward NestJS when you need modules, DI, OpenAPI decorators, and a stricter architecture. Consider Fastify when raw throughput and schema validation are the priority.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Node.js',
                        'slug' => 'nodejs',
                        'level' => 'Runtime',
                        'desc' => 'Express always runs on Node. Understand async I/O and modules before optimizing framework choice.',
                    ],
                    [
                        'name' => 'NestJS',
                        'slug' => 'nestjs',
                        'level' => 'When you outgrow Express structure',
                        'desc' => 'Better defaults for large TypeScript codebases; steeper learning curve than Express.',
                    ],
                    [
                        'name' => 'PostgreSQL',
                        'slug' => 'postgresql',
                        'level' => 'Common data store',
                        'desc' => 'Pair Express with PostgreSQL for relational APIs — users, orders, permissions, reporting.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: solid Express APIs',
                'bullets' => [
                    'Keep route handlers thin; put business logic in services',
                    'Centralize error handling — never leak stack traces to clients',
                    'Validate bodies and params (Zod, Joi, or celebrate)',
                    'Use environment-based config; never hardcode secrets',
                    'Add request logging and health-check routes early',
                    'Write a few integration tests for auth and critical CRUD paths',
                ],
            ],
            [
                'heading' => 'When Express is a good fit',
                'body' => [
                    'Choose Express for small-to-medium Node APIs, prototypes that may grow, and teams that want full control of architecture. If the codebase is large and TypeScript-first from day one, evaluate NestJS instead.',
                    'Need an Express API built or cleaned up? I take selective freelance Node/Express work — message me from the contact page.',
                ],
            ],
        ],
        'related_skills' => ['nodejs', 'nestjs', 'javascript', 'typescript', 'postgresql', 'rest-api', 'jwt', 'mongodb'],
        'faqs' => [
            [
                'question' => 'What is Express.js?',
                'answer' => 'Express.js is a minimal web framework for Node.js used to build HTTP APIs and web servers with routes and middleware.',
            ],
            [
                'question' => 'Is Express still used in 2026?',
                'answer' => 'Yes. Express remains widely used for Node APIs because it is simple, flexible, and supported by a large middleware ecosystem.',
            ],
            [
                'question' => 'Express vs NestJS — which should I choose?',
                'answer' => 'Use Express for smaller or flexible APIs. Use NestJS when you want opinionated TypeScript structure, modules, and patterns that scale with a larger team.',
            ],
            [
                'question' => 'Can you help with Express.js freelance work?',
                'answer' => 'Yes. I offer selective freelance help with Express APIs, auth, and database integration. Contact me via the hire form or LinkedIn.',
            ],
        ],
    ],

    'nestjs' => [
        'eyebrow' => 'NestJS guide',
        'title' => 'NestJS: structured TypeScript APIs on Node.js',
        'subtitle' => 'A NestJS developer guide covering modules, dependency injection, Express under the hood, and when Nest beats plain Express for scalable backends.',
        'seo_title' => 'NestJS Developer Guide — TypeScript APIs on Node.js | Madhusudan Timalsina',
        'seo_description' => 'Learn NestJS for Node.js: modules, DI, REST APIs, PostgreSQL, Express vs Nest, and practical backend guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'NestJS developer guide',
        'cta_label' => 'Hire a NestJS developer',
        'intro' => 'NestJS brings structure to Node.js backends with TypeScript, modules, and dependency injection. It is a strong choice when Express apps start to feel unstructured, or when a team wants Angular-like conventions on the server.',
        'sections' => [
            [
                'heading' => 'What is NestJS?',
                'body' => [
                    'NestJS is a progressive Node.js framework for building efficient, scalable server-side applications. It uses TypeScript by default and organizes code into modules, controllers, and providers.',
                    'Under the hood it can run on Express or Fastify, so you keep Node’s ecosystem while gaining clearer architecture, testing hooks, and patterns that fit larger products.',
                ],
            ],
            [
                'heading' => 'What you can build with NestJS',
                'body' => [
                    'Enterprise-style REST APIs, GraphQL servers, microservice gateways, auth/authorization layers, and domain-modular backends that multiple developers can extend safely.',
                    'I treat NestJS as a learning-to-proficient tool in my stack: ideal when a Node project needs more structure than Express alone, especially with PostgreSQL and typed DTOs.',
                ],
            ],
            [
                'heading' => 'Core NestJS concepts',
                'bullets' => [
                    'Modules, controllers, and providers (services)',
                    'Dependency injection and constructor injection',
                    'DTOs, pipes, guards, and interceptors',
                    'ConfigModule and environment-based settings',
                    'TypeORM/Prisma/Mongoose integrations',
                    'Exception filters and consistent API errors',
                    'Testing with Nest’s testing module',
                ],
            ],
            [
                'heading' => 'NestJS in the Node ecosystem',
                'body' => [
                    'Nest sits on top of Node and often Express. Knowing both helps you debug middleware, performance, and library choices.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Node.js',
                        'slug' => 'nodejs',
                        'level' => 'Runtime foundation',
                        'desc' => 'Nest always runs on Node. Async patterns and npm literacy still matter.',
                    ],
                    [
                        'name' => 'Express.js',
                        'slug' => 'express',
                        'level' => 'Default HTTP adapter',
                        'desc' => 'Many Nest apps use Express underneath. Express knowledge transfers to Nest middleware and request lifecycle.',
                    ],
                    [
                        'name' => 'PostgreSQL',
                        'slug' => 'postgresql',
                        'level' => 'Typical production DB',
                        'desc' => 'Pair Nest with PostgreSQL via TypeORM or Prisma for typed, relational APIs.',
                    ],
                    [
                        'name' => 'TypeScript',
                        'slug' => 'typescript',
                        'level' => 'First-class language',
                        'desc' => 'Nest is designed around TypeScript decorators, interfaces, and compile-time safety.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: learning NestJS effectively',
                'bullets' => [
                    'Know Express basics before Nest — it clarifies the HTTP layer',
                    'Start with one feature module (users/auth) end-to-end',
                    'Use class-validator DTOs on every write endpoint',
                    'Keep controllers thin; put logic in injectable services',
                    'Add a global exception filter early',
                    'Grow into microservices only after a solid monolith API',
                ],
            ],
            [
                'heading' => 'When NestJS is a good fit',
                'body' => [
                    'Choose Nest when the API will grow, multiple developers will contribute, or you want TypeScript structure from day one. Prefer Express for tiny services or quick experiments.',
                    'Exploring NestJS for a product or learning path? I can help scope architecture or implement modules — get in touch via contact.',
                ],
            ],
        ],
        'related_skills' => ['nodejs', 'express', 'typescript', 'postgresql', 'rest-api', 'jwt', 'docker', 'mongodb'],
        'faqs' => [
            [
                'question' => 'What is NestJS used for?',
                'answer' => 'NestJS is used to build structured Node.js backends — REST APIs, GraphQL services, and modular server applications — usually with TypeScript.',
            ],
            [
                'question' => 'Is NestJS better than Express?',
                'answer' => 'NestJS is better when you need architecture and TypeScript conventions. Express is better when you want minimal setup and maximum flexibility for smaller APIs.',
            ],
            [
                'question' => 'Does NestJS work with PostgreSQL?',
                'answer' => 'Yes. Nest commonly uses TypeORM, Prisma, or similar tools to talk to PostgreSQL for relational data models.',
            ],
            [
                'question' => 'Do you work with NestJS?',
                'answer' => 'NestJS is part of my active learning and project stack. I can help with Nest modules, APIs, and Node architecture on selective freelance engagements.',
            ],
        ],
    ],

    'django' => [
        'eyebrow' => 'Django guide',
        'title' => 'Django: Python web framework for apps and admin-heavy products',
        'subtitle' => 'A Django developer guide — MTV architecture, ORM, admin, REST with Django REST Framework, and how Django compares to Laravel and Node stacks.',
        'seo_title' => 'Django Developer Guide — Python Web Framework & APIs | Madhusudan Timalsina',
        'seo_description' => 'Learn Django for Python web development: ORM, admin, authentication, REST APIs, PostgreSQL, and practical guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'Django developer guide',
        'cta_label' => 'Hire a Django developer',
        'intro' => 'Django is a batteries-included Python web framework. It ships with an ORM, admin panel, auth, and a clear project layout — excellent for data-heavy apps, dashboards, and APIs when you want productivity in Python.',
        'sections' => [
            [
                'heading' => 'What is Django?',
                'body' => [
                    'Django follows a model–template–view pattern and emphasizes clean, pragmatic design. You define models, migrate the database, build views or API views, and optionally use the automatic admin for internal tools.',
                    'It is a top choice for Python teams building content platforms, business systems, analytics dashboards, and backends that need a trustworthy ORM and security defaults.',
                ],
            ],
            [
                'heading' => 'What you can build with Django',
                'body' => [
                    'Full server-rendered sites, admin-centric internal tools, Django REST Framework APIs for React/Vue/mobile, multi-tenant SaaS starters, and data collection apps that sit close to Python’s scientific/ML ecosystem.',
                    'Django is in my learning stack alongside FastAPI: I use Python where scripting, data models, or Django’s admin speed up delivery, while Laravel/Node cover much of my day-to-day production PHP/JS work.',
                ],
            ],
            [
                'heading' => 'Core Django concepts',
                'bullets' => [
                    'Projects vs apps, settings, and URLconf routing',
                    'Models, migrations, and the Django ORM',
                    'Views (FBV/CBV), templates, and forms',
                    'Authentication, permissions, and the admin site',
                    'Django REST Framework for JSON APIs',
                    'Middleware, signals, and management commands',
                    'Deploying with Gunicorn/uvicorn behind Nginx',
                ],
            ],
            [
                'heading' => 'Django and related tools',
                'body' => [
                    'Django rarely lives alone — you pick an API layer and a database that match the product.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Django REST Framework',
                        'slug' => null,
                        'level' => 'APIs on Django',
                        'desc' => 'Serializers, viewsets, and browsable APIs for building JSON backends on top of Django models.',
                    ],
                    [
                        'name' => 'PostgreSQL',
                        'slug' => 'postgresql',
                        'level' => 'Recommended database',
                        'desc' => 'Django’s ORM shines with PostgreSQL — constraints, indexes, and JSON fields for serious apps.',
                    ],
                    [
                        'name' => 'FastAPI',
                        'slug' => 'fastapi',
                        'level' => 'Alternative Python API style',
                        'desc' => 'Prefer FastAPI for pure API microservices; prefer Django when you want admin + ORM + monolith speed.',
                    ],
                    [
                        'name' => 'Python',
                        'slug' => 'python',
                        'level' => 'Language foundation',
                        'desc' => 'Solid Python (venv, packaging, typing basics) makes Django much easier to master.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: learning Django well',
                'bullets' => [
                    'Build one app with models + admin before touching DRF',
                    'Learn migrations early — treat schema changes as code',
                    'Use PostgreSQL locally (not only SQLite) before production',
                    'Keep business logic in models/services, not only in views',
                    'Enable Django’s security middleware and never disable CSRF casually',
                    'Compare with Laravel mentally: both are full-stack batteries-included frameworks',
                ],
            ],
            [
                'heading' => 'When Django is a good fit',
                'body' => [
                    'Choose Django for Python teams, admin-heavy products, content systems, and APIs that benefit from a mature ORM. Prefer FastAPI for tiny typed APIs, or Laravel/Node when the rest of your stack is already PHP/JS.',
                    'If you need Django guidance or a Python web spike, I can help on selective projects — contact me to talk scope.',
                ],
            ],
        ],
        'related_skills' => ['python', 'fastapi', 'postgresql', 'rest-api', 'docker', 'mysql', 'git'],
        'faqs' => [
            [
                'question' => 'What is Django used for?',
                'answer' => 'Django is used to build Python web applications: sites, admin tools, dashboards, and REST APIs (often with Django REST Framework).',
            ],
            [
                'question' => 'Is Django good for beginners?',
                'answer' => 'Yes, if you know basic Python. Django’s documentation and admin make it possible to ship a working CRUD app quickly.',
            ],
            [
                'question' => 'Django vs FastAPI?',
                'answer' => 'Django is better for full web apps with admin and ORM. FastAPI is better for high-performance, typed API-only services.',
            ],
            [
                'question' => 'Do you work with Django?',
                'answer' => 'Django is part of my Python learning and project stack. I can help with Django apps, ORM modeling, and API work on selective freelance engagements.',
            ],
        ],
    ],

    'postgresql' => [
        'eyebrow' => 'PostgreSQL guide',
        'title' => 'PostgreSQL: relational database design for real products',
        'subtitle' => 'A PostgreSQL developer guide — schemas, indexes, SQL vs ORM, pairing with Laravel/Node/Django, and practical database guidance for production apps.',
        'seo_title' => 'PostgreSQL Developer Guide — Database Design & SQL | Madhusudan Timalsina',
        'seo_description' => 'Learn PostgreSQL for web apps: schema design, indexes, transactions, Laravel/Node/Django usage, and database guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'PostgreSQL developer guide',
        'cta_label' => 'Hire for PostgreSQL / backend work',
        'intro' => 'PostgreSQL is a powerful open-source relational database. It is my go-to when apps need reliable transactions, clear schemas, and SQL you can trust — whether the API is Laravel, Node.js, or Django.',
        'sections' => [
            [
                'heading' => 'What is PostgreSQL?',
                'body' => [
                    'PostgreSQL (Postgres) is an advanced relational database system. You store data in tables with types, constraints, and relationships, then query it with SQL. It supports JSON, full-text search, and strong ACID transactions.',
                    'Compared with lighter options like SQLite, Postgres is built for concurrent users and production workloads. Compared with MySQL, it often wins on standards compliance, extensibility, and advanced querying.',
                ],
            ],
            [
                'heading' => 'What you use PostgreSQL for',
                'body' => [
                    'User accounts, orders, inventory, permissions, reporting, audit logs, and any domain where relationships matter. It backs APIs, admin panels, and analytics pipelines.',
                    'In my projects (including Laravel apps like Yfasma) I design schemas, migrations, and queries so data stays consistent as features grow — and I use Postgres when the product needs that reliability.',
                ],
            ],
            [
                'heading' => 'Core PostgreSQL concepts',
                'bullets' => [
                    'Tables, primary/foreign keys, and normalization basics',
                    'Indexes (B-tree and when to add them)',
                    'Transactions, commits, and rollbacks',
                    'Joins, aggregates, and EXPLAIN for slow queries',
                    'Migrations from Laravel, Django, Prisma, or raw SQL',
                    'Roles, privileges, and connection security',
                    'Backups (pg_dump) and basic performance hygiene',
                ],
            ],
            [
                'heading' => 'PostgreSQL with app frameworks',
                'body' => [
                    'Postgres is framework-agnostic — your app talks to it through an ORM or SQL client.',
                ],
                'frameworks' => [
                    [
                        'name' => 'Laravel',
                        'slug' => 'laravel',
                        'level' => 'Eloquent + migrations',
                        'desc' => 'Migrations, Eloquent relationships, and query builder on top of PostgreSQL for PHP products.',
                    ],
                    [
                        'name' => 'Node.js / Express / Nest',
                        'slug' => 'nodejs',
                        'level' => 'JS/TS backends',
                        'desc' => 'Use node-postgres, Prisma, Knex, or TypeORM to drive Postgres from Express or NestJS APIs.',
                    ],
                    [
                        'name' => 'Django',
                        'slug' => 'django',
                        'level' => 'Python ORM',
                        'desc' => 'Django’s ORM and migrations are commonly deployed against PostgreSQL in production.',
                    ],
                    [
                        'name' => 'MySQL',
                        'slug' => 'mysql',
                        'level' => 'Alternative RDBMS',
                        'desc' => 'Also strong for web apps; I pick Postgres when I want richer SQL features and stricter relational modeling.',
                    ],
                ],
            ],
            [
                'heading' => 'Guidance: designing databases well',
                'bullets' => [
                    'Model the real-world entities and relationships on paper first',
                    'Add foreign keys — do not rely on the app alone for integrity',
                    'Index columns you filter/join on frequently; do not index blindly',
                    'Keep migrations reversible when you can',
                    'Avoid N+1 queries — eager load in Laravel/Django/ORMs',
                    'Separate read-heavy reporting queries when they slow writes',
                ],
            ],
            [
                'heading' => 'When PostgreSQL is a good fit',
                'body' => [
                    'Choose PostgreSQL for multi-user products, relational domains, and backends that need transactions and reporting. Use SQLite for local/mobile prototypes; consider MongoDB when the document model truly fits better than tables.',
                    'Need schema design, migrations, or Postgres tuning alongside Laravel/Node? I offer selective freelance backend and database help — contact me to start.',
                ],
            ],
        ],
        'related_skills' => ['mysql', 'sqlite', 'laravel', 'nodejs', 'django', 'rest-api', 'docker', 'sql'],
        'faqs' => [
            [
                'question' => 'What is PostgreSQL used for?',
                'answer' => 'PostgreSQL is used as a relational database for web apps and APIs — storing users, business data, and relationships with strong SQL and transaction support.',
            ],
            [
                'question' => 'PostgreSQL vs MySQL?',
                'answer' => 'Both are solid. PostgreSQL is often preferred for complex queries, standards compliance, and advanced features; MySQL remains very common for many web hosts and apps.',
            ],
            [
                'question' => 'Does Laravel work with PostgreSQL?',
                'answer' => 'Yes. Laravel fully supports PostgreSQL through migrations, Eloquent, and the query builder.',
            ],
            [
                'question' => 'Can you help with PostgreSQL database design?',
                'answer' => 'Yes. I help with schema design, migrations, and backend integration for PostgreSQL on selective freelance projects.',
            ],
        ],
    ],

    'laravel' => [
        'eyebrow' => 'Laravel guide',
        'title' => 'Laravel: PHP framework for apps, APIs, and admin products',
        'subtitle' => 'Practical Laravel guidance — routing, Eloquent, auth, queues, and how I ship production PHP apps with Laravel.',
        'seo_title' => 'Laravel Developer Guide — PHP Framework & APIs | Madhusudan Timalsina',
        'seo_description' => 'Learn Laravel for PHP web apps: Eloquent, migrations, Sanctum APIs, Blade/Livewire, and real project guidance from a Laravel developer in Lalitpur, Nepal.',
        'h1' => 'Laravel developer guide',
        'cta_label' => 'Hire a Laravel developer',
        'intro' => 'Laravel is my primary PHP framework for custom web apps and APIs. It gives structure for routes, Eloquent models, validation, authentication, queues, and mail so products ship faster without sacrificing clarity.',
        'sections' => [
            [
                'heading' => 'What is Laravel?',
                'body' => [
                    'Laravel is a full-stack PHP framework with expressive syntax and batteries included: routing, ORM, migrations, queues, events, and first-party packages like Sanctum and Horizon.',
                    'It is the default choice for many PHP teams building SaaS, admin panels, e-commerce, and JSON APIs for React or mobile clients.',
                ],
            ],
            [
                'heading' => 'How I use Laravel',
                'body' => [
                    'At Smart Sarks and on freelance work I use Laravel for feature delivery, API endpoints, database design, and auth flows. Projects like Yfasma show Laravel architecture from routes to views and catalog data.',
                    'I combine Laravel with MySQL/PostgreSQL, Sanctum for APIs, and frontend tools such as Blade, Livewire, Vue, or React depending on the product.',
                ],
            ],
            [
                'heading' => 'Core Laravel skills',
                'bullets' => [
                    'Routing, controllers, form requests, and validation',
                    'Eloquent models, relationships, and eager loading',
                    'Migrations, seeders, and factories',
                    'Authentication, policies, and Sanctum tokens',
                    'Jobs, queues, notifications, and mail',
                    'Blade, Livewire, or API-only backends',
                    'Testing with Pest or PHPUnit',
                ],
            ],
            [
                'heading' => 'Laravel in the wider stack',
                'frameworks' => [
                    ['name' => 'PHP', 'slug' => 'php', 'level' => 'Language', 'desc' => 'Laravel is PHP — solid language fundamentals make framework work easier.'],
                    ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'level' => 'Database', 'desc' => 'Production-ready relational storage with migrations and Eloquent.'],
                    ['name' => 'MySQL', 'slug' => 'mysql', 'level' => 'Database', 'desc' => 'Common hosting default; fully supported by Laravel.'],
                    ['name' => 'Sanctum', 'slug' => 'sanctum', 'level' => 'API auth', 'desc' => 'SPA and token authentication for Laravel APIs.'],
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Start with CRUD + auth before packages and microservices',
                    'Keep controllers thin; use actions/services for business rules',
                    'Always validate and authorize — never trust the client',
                    'Watch for N+1 queries; use with() / load()',
                    'Prefer migrations over manual schema edits',
                ],
            ],
        ],
        'related_skills' => ['php', 'mysql', 'postgresql', 'sanctum', 'livewire', 'inertia', 'rest-api', 'pest'],
        'faqs' => [
            ['question' => 'What is Laravel used for?', 'answer' => 'Laravel is used to build PHP web applications, admin panels, e-commerce systems, and REST APIs with authentication and databases.'],
            ['question' => 'Do you take Laravel freelance work?', 'answer' => 'Yes — selective Laravel feature, API, and database work. Contact me via the hire form or LinkedIn.'],
            ['question' => 'Laravel vs plain PHP?', 'answer' => 'Plain PHP is fine for tiny scripts. Laravel is better when you need structure, auth, ORM, and maintainable app architecture.'],
        ],
    ],

    'javascript' => [
        'eyebrow' => 'JavaScript guide',
        'title' => 'JavaScript: the language of the web and Node backends',
        'subtitle' => 'JavaScript fundamentals for browsers and servers — and how it connects to React, Vue, Next.js, and Node.js in my work.',
        'seo_title' => 'JavaScript Developer Guide — Web & Node.js | Madhusudan Timalsina',
        'seo_description' => 'Learn JavaScript for web development: language basics, DOM, async patterns, React/Vue/Node usage, and guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'JavaScript developer guide',
        'cta_label' => 'Hire a JavaScript developer',
        'intro' => 'JavaScript runs in every browser and, with Node.js, on the server. It is the shared language behind modern UI frameworks and many APIs I build or integrate.',
        'sections' => [
            [
                'heading' => 'What is JavaScript?',
                'body' => [
                    'JavaScript is a dynamic language for interactive web pages, SPAs, and increasingly backends via Node.js. ES modules, async/await, and TypeScript-friendly patterns keep it central to product development.',
                ],
            ],
            [
                'heading' => 'How I use JavaScript',
                'body' => [
                    'I use JavaScript for UI behavior, React/Vue components, Node services, and API clients. Strong JS fundamentals make frontend frameworks and Express/Nest APIs much easier to ship.',
                ],
            ],
            [
                'heading' => 'Core concepts',
                'bullets' => [
                    'Variables, functions, arrays, objects, and modules',
                    'DOM events and fetch/XHR for APIs',
                    'Promises and async/await',
                    'Closures, scope, and immutability habits',
                    'Tooling: npm/pnpm, bundlers, and linting',
                ],
            ],
            [
                'heading' => 'Related frameworks',
                'frameworks' => [
                    ['name' => 'React', 'slug' => 'react', 'level' => 'UI library', 'desc' => 'Component UIs for dashboards and product frontends.'],
                    ['name' => 'Vue.js', 'slug' => 'vue', 'level' => 'UI framework', 'desc' => 'Approachable reactive UI with strong Laravel pairing.'],
                    ['name' => 'Node.js', 'slug' => 'nodejs', 'level' => 'Server runtime', 'desc' => 'JavaScript on the backend for APIs and tooling.'],
                    ['name' => 'TypeScript', 'slug' => 'typescript', 'level' => 'Typed JS', 'desc' => 'Add types when apps and teams grow.'],
                ],
            ],
        ],
        'related_skills' => ['typescript', 'react', 'vue', 'nodejs', 'nextjs', 'express', 'jest'],
        'faqs' => [
            ['question' => 'Is JavaScript still essential?', 'answer' => 'Yes. Browsers run JavaScript, and Node extends it to servers. Most modern web products depend on it.'],
            ['question' => 'Should I learn TypeScript too?', 'answer' => 'Learn JavaScript first, then TypeScript for larger apps and Nest/React codebases.'],
        ],
    ],

    'typescript' => [
        'eyebrow' => 'TypeScript guide',
        'title' => 'TypeScript: typed JavaScript for safer apps',
        'subtitle' => 'Why TypeScript helps React, NestJS, and Node APIs stay maintainable as products grow.',
        'seo_title' => 'TypeScript Developer Guide — Typed JavaScript | Madhusudan Timalsina',
        'seo_description' => 'Learn TypeScript for web apps: types, interfaces, React/Nest usage, and practical guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'TypeScript developer guide',
        'cta_label' => 'Hire a TypeScript developer',
        'intro' => 'TypeScript adds static types to JavaScript. It catches bugs earlier and documents intent — especially valuable in NestJS, React, and shared API contracts.',
        'sections' => [
            [
                'heading' => 'What is TypeScript?',
                'body' => [
                    'TypeScript compiles to JavaScript and adds types, interfaces, enums, and better editor tooling. Teams adopt it when codebases and collaborators grow.',
                ],
            ],
            [
                'heading' => 'How I use TypeScript',
                'body' => [
                    'I use TypeScript on Nest/React-style work and whenever API payloads should be explicit. It pairs well with Node backends and modern frontends.',
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Type function inputs/outputs and API DTOs first',
                    'Prefer unknown + narrowing over any',
                    'Share types between frontend and backend when possible',
                    'Keep tsconfig strictness honest for the team level',
                ],
            ],
        ],
        'related_skills' => ['javascript', 'react', 'nestjs', 'nodejs', 'nextjs'],
        'faqs' => [
            ['question' => 'TypeScript vs JavaScript?', 'answer' => 'TypeScript is JavaScript with types. You still ship JS, but you develop with stronger guarantees.'],
            ['question' => 'Do you use TypeScript professionally?', 'answer' => 'Yes — proficient usage across frontend and Node/Nest-style backends when the project benefits from types.'],
        ],
    ],

    'python' => [
        'eyebrow' => 'Python guide',
        'title' => 'Python: scripting, APIs, and Django/FastAPI backends',
        'subtitle' => 'Python for web backends and automation — with Django, FastAPI, and PostgreSQL in the learning and project path.',
        'seo_title' => 'Python Developer Guide — Django, FastAPI & Scripting | Madhusudan Timalsina',
        'seo_description' => 'Learn Python for web development: scripting, Django, FastAPI, PostgreSQL, and guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'Python developer guide',
        'cta_label' => 'Hire a Python developer',
        'intro' => 'Python is clear, productive, and excellent for APIs, automation, and data-friendly backends. I use it alongside PHP/JS stacks when scripting or Django/FastAPI fits the job.',
        'sections' => [
            [
                'heading' => 'What is Python?',
                'body' => [
                    'Python is a high-level language known for readable syntax. It powers web frameworks (Django, FastAPI), scripting, CLIs, and data tooling.',
                ],
            ],
            [
                'heading' => 'How I use Python',
                'body' => [
                    'I use Python for backend learning projects, API experiments with FastAPI/Django, and scripts that support delivery. It complements Laravel/Node when the problem is a better fit for Python.',
                ],
            ],
            [
                'heading' => 'Frameworks & tools',
                'frameworks' => [
                    ['name' => 'Django', 'slug' => 'django', 'level' => 'Full framework', 'desc' => 'Batteries-included web apps and admin.'],
                    ['name' => 'FastAPI', 'slug' => 'fastapi', 'level' => 'API-first', 'desc' => 'Typed, fast APIs with OpenAPI built in.'],
                    ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'level' => 'Database', 'desc' => 'Common production database for Python web apps.'],
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Learn virtualenvs and packaging early',
                    'Prefer clear functions and type hints on APIs',
                    'Pick Django for admin-heavy apps, FastAPI for pure APIs',
                    'Always parameterize SQL / use an ORM safely',
                ],
            ],
        ],
        'related_skills' => ['django', 'fastapi', 'postgresql', 'rest-api', 'docker'],
        'faqs' => [
            ['question' => 'Is Python good for web APIs?', 'answer' => 'Yes. Django REST Framework and FastAPI are popular choices for production APIs.'],
            ['question' => 'Do you offer Python freelance work?', 'answer' => 'Selective Python/Django/FastAPI help is available — contact me with your scope.'],
        ],
    ],

    'react' => [
        'eyebrow' => 'React guide',
        'title' => 'React: component UI for modern web apps',
        'subtitle' => 'React fundamentals, hooks, API integration, and how I build interfaces that talk to Laravel or Node backends.',
        'seo_title' => 'React Developer Guide — Components, Hooks & APIs | Madhusudan Timalsina',
        'seo_description' => 'Learn React for web UIs: components, hooks, Next.js, API integration, and guidance from a React developer in Lalitpur, Nepal.',
        'h1' => 'React developer guide',
        'cta_label' => 'Hire a React developer',
        'intro' => 'React is a library for building user interfaces from components. I use it for dashboards, product screens, and API-driven frontends that need clear state and reusable UI.',
        'sections' => [
            [
                'heading' => 'What is React?',
                'body' => [
                    'React lets you compose UIs with components and declarative rendering. Hooks manage state and side effects; ecosystems like Next.js add routing and SSR.',
                ],
            ],
            [
                'heading' => 'How I use React',
                'body' => [
                    'I build React interfaces that consume REST APIs — often from Laravel or Node — with attention to loading states, forms, and responsive layout. Next.js is the usual step up for full product frontends.',
                ],
            ],
            [
                'heading' => 'Core skills',
                'bullets' => [
                    'Components, props, and composition',
                    'useState, useEffect, and custom hooks',
                    'Fetching APIs and handling errors',
                    'Forms, lists, and conditional UI',
                    'Basic performance: keys, memoization when needed',
                ],
            ],
            [
                'heading' => 'Related stack',
                'frameworks' => [
                    ['name' => 'Next.js', 'slug' => 'nextjs', 'level' => 'React framework', 'desc' => 'Routing, SSR/SSG, and full-stack React apps.'],
                    ['name' => 'TypeScript', 'slug' => 'typescript', 'level' => 'Types', 'desc' => 'Safer props and API types in larger UIs.'],
                    ['name' => 'REST API', 'slug' => 'rest-api', 'level' => 'Data', 'desc' => 'Most React apps talk to JSON APIs.'],
                ],
            ],
        ],
        'related_skills' => ['nextjs', 'javascript', 'typescript', 'vue', 'rest-api', 'tailwind'],
        'faqs' => [
            ['question' => 'React vs Vue?', 'answer' => 'Both build component UIs. React has a larger ecosystem; Vue is often quicker to learn and pairs nicely with Laravel.'],
            ['question' => 'Do you build React frontends for hire?', 'answer' => 'Yes — selective React/Next UI work against existing APIs. Contact me to discuss.'],
        ],
    ],

    'nextjs' => [
        'eyebrow' => 'Next.js guide',
        'title' => 'Next.js: React framework for production frontends',
        'subtitle' => 'App Router, server components, API routes, and when Next.js beats a plain React SPA.',
        'seo_title' => 'Next.js Developer Guide — React Framework | Madhusudan Timalsina',
        'seo_description' => 'Learn Next.js for React apps: routing, SSR, API routes, and practical guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'Next.js developer guide',
        'cta_label' => 'Hire a Next.js developer',
        'intro' => 'Next.js is the React framework for production: file-based routing, server rendering, and optional API routes. I use it when a React product needs SEO, performance, and a clear app structure.',
        'sections' => [
            [
                'heading' => 'What is Next.js?',
                'body' => [
                    'Next.js extends React with routing, rendering strategies (SSR/SSG/ISR), image optimization, and full-stack capabilities so you can ship product UIs without wiring a custom bundler setup.',
                ],
            ],
            [
                'heading' => 'How I use Next.js',
                'body' => [
                    'I reach for Next.js on React frontends that need routing and server rendering, or when API routes are enough for a focused backend. It often sits in front of Laravel/Node APIs.',
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Know React hooks before App Router deep dives',
                    'Decide server vs client components intentionally',
                    'Fetch data close to where it is rendered',
                    'Keep secrets on the server — never in client bundles',
                ],
            ],
        ],
        'related_skills' => ['react', 'typescript', 'nodejs', 'rest-api', 'tailwind'],
        'faqs' => [
            ['question' => 'Is Next.js only for frontend?', 'answer' => 'Primarily yes, but route handlers/server actions let you add backend logic in the same project.'],
            ['question' => 'Next.js vs plain React?', 'answer' => 'Plain React is a library. Next.js is a framework with routing and rendering defaults for real products.'],
        ],
    ],

    'vue' => [
        'eyebrow' => 'Vue.js guide',
        'title' => 'Vue.js: approachable reactive UI for web apps',
        'subtitle' => 'Vue components, Composition API, and pairing Vue with Laravel APIs or Inertia.',
        'seo_title' => 'Vue.js Developer Guide — Frontend Framework | Madhusudan Timalsina',
        'seo_description' => 'Learn Vue.js for web UIs: components, Composition API, Laravel pairing, and guidance from a Vue developer in Lalitpur, Nepal.',
        'h1' => 'Vue.js developer guide',
        'cta_label' => 'Hire a Vue.js developer',
        'intro' => 'Vue.js is a progressive framework for building UIs. It is approachable, flexible, and a natural fit with Laravel via Inertia, API backends, or Blade + Vue islands.',
        'sections' => [
            [
                'heading' => 'What is Vue.js?',
                'body' => [
                    'Vue provides reactive data binding and a component model with Single File Components (template + script + style). The Composition API scales complexity cleanly.',
                ],
            ],
            [
                'heading' => 'How I use Vue',
                'body' => [
                    'I use Vue for interactive frontends and Laravel-friendly UIs — including API-driven screens and progressive enhancement where a full React stack is unnecessary.',
                ],
            ],
            [
                'heading' => 'Related tools',
                'frameworks' => [
                    ['name' => 'Nuxt', 'slug' => 'nuxt', 'level' => 'Vue framework', 'desc' => 'Full-stack Vue with routing and SSR similar to Next for React.'],
                    ['name' => 'Inertia.js', 'slug' => 'inertia', 'level' => 'Laravel bridge', 'desc' => 'Build Vue SPAs driven by Laravel routes without a separate API.'],
                    ['name' => 'Laravel', 'slug' => 'laravel', 'level' => 'Backend', 'desc' => 'Common pairing for Vue dashboards and product UIs.'],
                ],
            ],
        ],
        'related_skills' => ['nuxt', 'javascript', 'inertia', 'laravel', 'tailwind', 'rest-api'],
        'faqs' => [
            ['question' => 'Vue vs React?', 'answer' => 'Both are excellent. Vue often feels simpler to start; React has a broader job market and ecosystem.'],
            ['question' => 'Do you build Vue apps for hire?', 'answer' => 'Yes — selective Vue/Laravel UI work. Reach out via contact.'],
        ],
    ],

    'mysql' => [
        'eyebrow' => 'MySQL guide',
        'title' => 'MySQL: relational data for PHP and web apps',
        'subtitle' => 'Schema design, indexes, Laravel migrations, and when to choose MySQL vs PostgreSQL.',
        'seo_title' => 'MySQL Developer Guide — Database Design | Madhusudan Timalsina',
        'seo_description' => 'Learn MySQL for web apps: tables, indexes, Laravel usage, vs PostgreSQL, and database guidance from a developer in Lalitpur, Nepal.',
        'h1' => 'MySQL developer guide',
        'cta_label' => 'Hire for MySQL / backend work',
        'intro' => 'MySQL is one of the most common databases for web applications. I use it with Laravel and PHP apps for CRUD systems, catalogs, and production data that needs relational integrity.',
        'sections' => [
            [
                'heading' => 'What is MySQL?',
                'body' => [
                    'MySQL is an open-source relational database. You define tables, keys, and relationships, then query with SQL. It is widely supported by hosts and frameworks.',
                ],
            ],
            [
                'heading' => 'How I use MySQL',
                'body' => [
                    'I design schemas and migrations for Laravel/PHP products, write safe queries, and tune indexes when lists and filters grow. Projects like Yfasma and campus apps use relational MySQL/SQL patterns.',
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Normalize first; denormalize only with a reason',
                    'Add foreign keys for real relationships',
                    'Index filter/join columns you use often',
                    'Use migrations — avoid click-ops schema drift',
                    'Prefer Eloquent/query builder over string-concat SQL',
                ],
            ],
            [
                'heading' => 'MySQL vs PostgreSQL',
                'frameworks' => [
                    ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'level' => 'Alternative', 'desc' => 'Choose Postgres for richer SQL features; MySQL when hosting/ecosystem defaults that way.'],
                    ['name' => 'Laravel', 'slug' => 'laravel', 'level' => 'App layer', 'desc' => 'Eloquent and migrations work great with MySQL.'],
                    ['name' => 'PHP', 'slug' => 'php', 'level' => 'Language', 'desc' => 'Classic LAMP/LEMP pairing with MySQL.'],
                ],
            ],
        ],
        'related_skills' => ['postgresql', 'sqlite', 'laravel', 'php', 'sql', 'rest-api'],
        'faqs' => [
            ['question' => 'Is MySQL still a good choice?', 'answer' => 'Yes. It remains a solid, widely hosted relational database for web apps.'],
            ['question' => 'Can you help with MySQL schema design?', 'answer' => 'Yes — selective database design and Laravel/MySQL integration work. Contact me to start.'],
        ],
    ],

    'rest-api' => [
        'eyebrow' => 'REST API guide',
        'title' => 'REST APIs: contracts between frontend, mobile, and backend',
        'subtitle' => 'Designing JSON APIs with clear resources, status codes, auth, and Laravel/Node implementation patterns.',
        'seo_title' => 'REST API Developer Guide — Design & Integration | Madhusudan Timalsina',
        'seo_description' => 'Learn REST API design: resources, HTTP methods, auth, Laravel/Node implementation, and guidance from an API developer in Lalitpur, Nepal.',
        'h1' => 'REST API developer guide',
        'cta_label' => 'Hire for API development',
        'intro' => 'REST APIs let web and mobile clients talk to your backend over HTTP with JSON. Clear resources, validation, and auth are the difference between a fragile integration and a product teams can extend.',
        'sections' => [
            [
                'heading' => 'What is a REST API?',
                'body' => [
                    'A REST API exposes resources (users, orders, posts) through URLs and HTTP verbs (GET, POST, PUT/PATCH, DELETE). Clients send and receive JSON without coupling to server templates.',
                ],
            ],
            [
                'heading' => 'How I build APIs',
                'body' => [
                    'I implement REST endpoints in Laravel (Sanctum) and Node/Express/Nest, with validation, consistent error shapes, and database-backed resources. Frontend React/Vue apps consume those contracts.',
                ],
            ],
            [
                'heading' => 'Guidance',
                'bullets' => [
                    'Name resources as nouns; keep verbs in HTTP methods',
                    'Return correct status codes (201, 422, 401, 404…)',
                    'Validate all input; never trust client IDs for authz',
                    'Version or document breaking changes',
                    'Paginate list endpoints early',
                ],
            ],
            [
                'heading' => 'Stack pairing',
                'frameworks' => [
                    ['name' => 'Laravel', 'slug' => 'laravel', 'level' => 'PHP APIs', 'desc' => 'API resources, Form Requests, Sanctum.'],
                    ['name' => 'Node.js', 'slug' => 'nodejs', 'level' => 'JS APIs', 'desc' => 'Express/Nest JSON services.'],
                    ['name' => 'JWT / Sanctum', 'slug' => 'jwt', 'level' => 'Auth', 'desc' => 'Token patterns for SPA and mobile clients.'],
                ],
            ],
        ],
        'related_skills' => ['laravel', 'nodejs', 'express', 'sanctum', 'jwt', 'oauth', 'postman'],
        'faqs' => [
            ['question' => 'REST vs GraphQL?', 'answer' => 'REST is simpler and widely understood. GraphQL shines when clients need flexible queries over many related fields.'],
            ['question' => 'Do you build APIs for hire?', 'answer' => 'Yes — Laravel and Node REST API design and implementation on selective freelance projects.'],
        ],
    ],
];
