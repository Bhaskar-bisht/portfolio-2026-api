<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Project;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Achievement;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create User (Owner)
        $user = User::create([
            'name' => 'bhaskar bisht',
            'email' => 'bhaskar.s.bist@gmail.com',
            'password' => bcrypt('bhaskar123'),
            'bio' => 'Full Stack Developer specializing in Laravel, React, and modern web technologies. Passionate about creating scalable and user-friendly applications.',
            'tagline' => 'Building Digital Experiences That Matter',
            'current_position' => 'Full Stack Developer',
            'years_of_experience' => 3,
            'location' => 'Delhi, India',
            'timezone' => 'Asia/Kolkata',
            'availability_status' => 'available',
            'github_url' => 'https://github.com/bhaskarbisht',
            'linkedin_url' => 'https://linkedin.com/in/bhaskarbisht',
            'twitter_url' => 'https://twitter.com/bhaskarbisht',
        ]);

        // 2. Create Categories
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development', 'color_code' => '#3B82F6', 'is_active' => true, 'display_order' => 1],
            ['name' => 'Mobile App', 'slug' => 'mobile-app', 'color_code' => '#10B981', 'is_active' => true, 'display_order' => 2],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'color_code' => '#F59E0B', 'is_active' => true, 'display_order' => 3],
            ['name' => 'E-Commerce', 'slug' => 'e-commerce', 'color_code' => '#8B5CF6', 'is_active' => true, 'display_order' => 4],
            ['name' => 'API Development', 'slug' => 'api-development', 'color_code' => '#EF4444', 'is_active' => true, 'display_order' => 5],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // 3. Create Technologies
        $technologies = [
            // Frontend
            ['name' => 'React', 'slug' => 'react', 'category' => 'framework', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#61DAFB', 'is_featured' => true, 'display_order' => 1],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'category' => 'language', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#F7DF1E', 'is_featured' => true, 'display_order' => 2],
            ['name' => 'TypeScript', 'slug' => 'typescript', 'category' => 'language', 'proficiency_level' => 'intermediate', 'years_of_experience' => 2, 'color_code' => '#3178C6', 'is_featured' => true, 'display_order' => 3],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css', 'category' => 'framework', 'proficiency_level' => 'expert', 'years_of_experience' => 2, 'color_code' => '#06B6D4', 'is_featured' => true, 'display_order' => 4],
            ['name' => 'Next.js', 'slug' => 'nextjs', 'category' => 'framework', 'proficiency_level' => 'intermediate', 'years_of_experience' => 2, 'color_code' => '#000000', 'is_featured' => false, 'display_order' => 5],

            // Backend
            ['name' => 'PHP', 'slug' => 'php', 'category' => 'language', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#777BB4', 'is_featured' => true, 'display_order' => 6],
            ['name' => 'Laravel', 'slug' => 'laravel', 'category' => 'framework', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#FF2D20', 'is_featured' => true, 'display_order' => 7],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'category' => 'framework', 'proficiency_level' => 'intermediate', 'years_of_experience' => 2, 'color_code' => '#339933', 'is_featured' => false, 'display_order' => 8],
            ['name' => 'REST API', 'slug' => 'rest-api', 'category' => 'other', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#FF6C37', 'is_featured' => false, 'display_order' => 9],

            // Database
            ['name' => 'MySQL', 'slug' => 'mysql', 'category' => 'database', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#4479A1', 'is_featured' => true, 'display_order' => 10],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'category' => 'database', 'proficiency_level' => 'intermediate', 'years_of_experience' => 1, 'color_code' => '#336791', 'is_featured' => false, 'display_order' => 11],
            ['name' => 'MongoDB', 'slug' => 'mongodb', 'category' => 'database', 'proficiency_level' => 'intermediate', 'years_of_experience' => 1, 'color_code' => '#47A248', 'is_featured' => false, 'display_order' => 12],

            // Tools
            ['name' => 'Git', 'slug' => 'git', 'category' => 'tool', 'proficiency_level' => 'expert', 'years_of_experience' => 3, 'color_code' => '#F05032', 'is_featured' => true, 'display_order' => 13],
            ['name' => 'Docker', 'slug' => 'docker', 'category' => 'devops', 'proficiency_level' => 'intermediate', 'years_of_experience' => 1, 'color_code' => '#2496ED', 'is_featured' => false, 'display_order' => 14],
            ['name' => 'Figma', 'slug' => 'figma', 'category' => 'tool', 'proficiency_level' => 'intermediate', 'years_of_experience' => 2, 'color_code' => '#F24E1E', 'is_featured' => false, 'display_order' => 15],
            ['name' => 'Filament', 'slug' => 'filament', 'category' => 'framework', 'proficiency_level' => 'expert', 'years_of_experience' => 2, 'color_code' => '#FDAE4B', 'is_featured' => true, 'display_order' => 16],
        ];

        foreach ($technologies as $tech) {
            Technology::create($tech);
        }

        // 4. Create Projects
        $projects = [
            [
                'user_id' => $user->id,
                'title' => 'E-Commerce Platform - ShopEasy',
                'slug' => 'e-commerce-platform-shopeasy',
                'short_description' => 'A full-featured e-commerce platform with admin panel, payment integration, and real-time inventory management.',
                'full_description' => "ShopEasy is a comprehensive e-commerce solution built with Laravel and React. It features a modern, responsive design with Tailwind CSS and includes:\n\n- Complete product management system\n- Shopping cart and checkout process\n- Payment gateway integration (Stripe, PayPal)\n- Order tracking and management\n- Admin dashboard with Filament\n- Real-time notifications\n- Email marketing integration\n- SEO optimized pages\n\nThe platform handles 10,000+ products and serves 5,000+ daily active users.",
                'project_type' => 'web',
                'status' => 'completed',
                'featured' => true,
                'priority' => 1,
                'client_name' => 'ShopEasy Retail Pvt Ltd',
                'client_feedback' => 'Bhaskar delivered an exceptional e-commerce platform that exceeded our expectations. The admin panel is intuitive and the performance is outstanding.',
                'project_url' => 'https://shopeasy-demo.com',
                'github_url' => 'https://github.com/bhaskarbisht/shopeasy',
                'demo_url' => 'https://demo.shopeasy.com',
                'started_at' => '2023-06-01',
                'completed_at' => '2024-02-15',
                'budget_range' => '$5,000 - $10,000',
                'team_size' => 3,
                'views_count' => 1250,
                'likes_count' => 89,
                'is_published' => true,
                'meta_title' => 'ShopEasy - Modern E-Commerce Platform',
                'meta_description' => 'Full-stack e-commerce platform built with Laravel and React',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Task Management System - TaskFlow',
                'slug' => 'task-management-system-taskflow',
                'short_description' => 'A collaborative task management application with real-time updates, team collaboration features, and project tracking.',
                'full_description' => "TaskFlow is a modern project management tool designed for agile teams. Built with Laravel backend and React frontend, it provides:\n\n- Kanban-style task boards\n- Real-time collaboration with WebSockets\n- Time tracking and reporting\n- Team member management\n- File attachments and comments\n- Email notifications\n- Mobile responsive design\n- Dark mode support\n\nThe application supports unlimited projects and team members with role-based access control.",
                'project_type' => 'web',
                'status' => 'completed',
                'featured' => true,
                'priority' => 2,
                'client_name' => 'TechStart Solutions',
                'client_feedback' => 'TaskFlow has transformed how our team manages projects. The real-time features are game-changing!',
                'project_url' => 'https://taskflow-app.com',
                'github_url' => 'https://github.com/bhaskarbisht/taskflow',
                'demo_url' => 'https://demo.taskflow-app.com',
                'started_at' => '2023-01-10',
                'completed_at' => '2023-05-20',
                'budget_range' => '$3,000 - $5,000',
                'team_size' => 2,
                'views_count' => 856,
                'likes_count' => 67,
                'is_published' => true,
                'meta_title' => 'TaskFlow - Agile Project Management',
                'meta_description' => 'Real-time task management system with team collaboration',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Restaurant Ordering App - FoodHub',
                'slug' => 'restaurant-ordering-app-foodhub',
                'short_description' => 'Mobile-first food ordering platform with QR code menus, real-time order tracking, and kitchen management system.',
                'full_description' => "FoodHub revolutionizes restaurant ordering with a complete digital solution:\n\n- QR code-based digital menus\n- Online ordering and table reservations\n- Real-time order tracking\n- Kitchen display system (KDS)\n- Payment integration\n- Customer loyalty program\n- Analytics dashboard\n- Multi-language support\n- WhatsApp order notifications\n\nCurrently serving 50+ restaurants with 10,000+ monthly orders.",
                'project_type' => 'web',
                'status' => 'in_progress',
                'featured' => true,
                'priority' => 3,
                'client_name' => 'FoodHub India',
                'client_feedback' => 'The app has streamlined our entire ordering process. Customer satisfaction has increased by 40%.',
                'project_url' => 'https://foodhub.app',
                'github_url' => null,
                'demo_url' => 'https://demo.foodhub.app',
                'started_at' => '2024-03-01',
                'completed_at' => null,
                'budget_range' => '$8,000 - $12,000',
                'team_size' => 4,
                'views_count' => 542,
                'likes_count' => 45,
                'is_published' => true,
                'meta_title' => 'FoodHub - Restaurant Ordering Platform',
                'meta_description' => 'Complete restaurant management and ordering solution',
            ],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);

            // Attach categories to projects
            if ($project->slug === 'e-commerce-platform-shopeasy') {
                $project->categories()->attach([1, 4]); // Web Development, E-Commerce
                $project->technologies()->attach([
                    1 => ['usage_percentage' => 40, 'role' => 'primary'], // React
                    2 => ['usage_percentage' => 35, 'role' => 'primary'], // JavaScript
                    4 => ['usage_percentage' => 30, 'role' => 'primary'], // Tailwind
                    6 => ['usage_percentage' => 45, 'role' => 'primary'], // PHP
                    7 => ['usage_percentage' => 50, 'role' => 'primary'], // Laravel
                    10 => ['usage_percentage' => 30, 'role' => 'secondary'], // MySQL
                    16 => ['usage_percentage' => 25, 'role' => 'secondary'], // Filament
                ]);

                // Add project features
                $project->features()->createMany([
                    ['title' => 'Advanced Product Management', 'description' => 'Comprehensive product catalog with variants, inventory tracking, and bulk operations', 'display_order' => 1],
                    ['title' => 'Secure Payment Processing', 'description' => 'Integration with Stripe and PayPal for secure transactions', 'display_order' => 2],
                    ['title' => 'Real-time Inventory Updates', 'description' => 'Live stock management with automatic notifications', 'display_order' => 3],
                    ['title' => 'Powerful Admin Dashboard', 'description' => 'Built with Filament for intuitive backend management', 'display_order' => 4],
                ]);
            }

            if ($project->slug === 'task-management-system-taskflow') {
                $project->categories()->attach([1, 5]); // Web Development, API Development
                $project->technologies()->attach([
                    1 => ['usage_percentage' => 45, 'role' => 'primary'], // React
                    2 => ['usage_percentage' => 40, 'role' => 'primary'], // JavaScript
                    3 => ['usage_percentage' => 35, 'role' => 'primary'], // TypeScript
                    7 => ['usage_percentage' => 45, 'role' => 'primary'], // Laravel
                    9 => ['usage_percentage' => 40, 'role' => 'primary'], // REST API
                    10 => ['usage_percentage' => 25, 'role' => 'secondary'], // MySQL
                ]);

                $project->features()->createMany([
                    ['title' => 'Kanban Boards', 'description' => 'Drag-and-drop task management with customizable workflows', 'display_order' => 1],
                    ['title' => 'Real-time Collaboration', 'description' => 'WebSocket-powered live updates for team members', 'display_order' => 2],
                    ['title' => 'Time Tracking', 'description' => 'Built-in timer and detailed reporting', 'display_order' => 3],
                    ['title' => 'Team Management', 'description' => 'Role-based access control and permissions', 'display_order' => 4],
                ]);
            }

            if ($project->slug === 'restaurant-ordering-app-foodhub') {
                $project->categories()->attach([1, 2]); // Web Development, Mobile App
                $project->technologies()->attach([
                    1 => ['usage_percentage' => 50, 'role' => 'primary'], // React
                    5 => ['usage_percentage' => 35, 'role' => 'primary'], // Next.js
                    7 => ['usage_percentage' => 40, 'role' => 'primary'], // Laravel
                    10 => ['usage_percentage' => 30, 'role' => 'secondary'], // MySQL
                    4 => ['usage_percentage' => 35, 'role' => 'primary'], // Tailwind
                ]);

                $project->features()->createMany([
                    ['title' => 'QR Code Menus', 'description' => 'Contactless digital menus accessible via QR codes', 'display_order' => 1],
                    ['title' => 'Order Tracking', 'description' => 'Real-time updates from kitchen to table', 'display_order' => 2],
                    ['title' => 'Kitchen Display System', 'description' => 'Efficient order management for kitchen staff', 'display_order' => 3],
                    ['title' => 'Customer Loyalty', 'description' => 'Points-based rewards program', 'display_order' => 4],
                ]);
            }

            // Add testimonial for each project
            $project->testimonials()->create([
                'testimonial_type' => 'client',
                'name' => $projectData['client_name'],
                'position' => 'Project Manager',
                'company' => $projectData['client_name'],
                'content' => $projectData['client_feedback'],
                'rating' => 5,
                'is_featured' => true,
                'is_approved' => true,
                'display_order' => 1,
            ]);
        }

        // 5. Create Education
        $educations = [
            [
                'user_id' => $user->id,
                'institution_name' => 'Delhi Public School',
                'degree' => '12th Standard',
                'field_of_study' => 'Science (PCM)',
                'grade' => '85%',
                'start_date' => '2020-04-01',
                'end_date' => '2021-03-31',
                'is_current' => false,
                'description' => 'Completed higher secondary education with focus on Physics, Chemistry, and Mathematics.',
                'achievements' => 'School topper in Computer Science, Participated in National Science Olympiad',
                'location' => 'Delhi, India',
                'display_order' => 2,
            ],
            [
                'user_id' => $user->id,
                'institution_name' => 'Government Polytechnic College',
                'degree' => 'Diploma',
                'field_of_study' => 'Information Technology',
                'grade' => '8.5 CGPA',
                'start_date' => '2021-07-01',
                'end_date' => '2024-05-31',
                'is_current' => false,
                'description' => 'Comprehensive three-year diploma program covering web development, database management, networking, and software engineering principles.',
                'achievements' => 'Final year project on E-Commerce Platform received Best Project Award, Led college coding club, Won inter-college hackathon 2023',
                'location' => 'Delhi, India',
                'display_order' => 1,
            ],
        ];

        foreach ($educations as $edu) {
            Education::create($edu);
        }

        // 6. Create Experience
        $experiences = [
            [
                'user_id' => $user->id,
                'company_name' => 'TechSolutions India',
                'position' => 'Full Stack Developer',
                'employment_type' => 'full_time',
                'location' => 'Delhi, India',
                'is_remote' => false,
                'start_date' => '2024-06-01',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Working as a full-stack developer building scalable web applications using Laravel and React. Responsibilities include developing RESTful APIs, implementing frontend components, database design, and collaborating with cross-functional teams.',
                'achievements' => json_encode([
                    'Developed 3 major client projects generating $50K+ revenue',
                    'Reduced API response time by 40% through optimization',
                    'Mentored 2 junior developers',
                    'Implemented CI/CD pipeline reducing deployment time by 60%',
                ]),
                'company_url' => 'https://techsolutions.in',
                'display_order' => 1,
            ],
            [
                'user_id' => $user->id,
                'company_name' => 'WebCraft Studio',
                'position' => 'Junior Web Developer',
                'employment_type' => 'full_time',
                'location' => 'Delhi, India',
                'is_remote' => false,
                'start_date' => '2023-07-01',
                'end_date' => '2024-05-31',
                'is_current' => false,
                'description' => 'Started career as a junior web developer, working on various client projects. Gained hands-on experience with modern web technologies and agile development practices.',
                'achievements' => json_encode([
                    'Successfully delivered 10+ client websites',
                    'Improved code quality through implementation of ESLint and PHP CS Fixer',
                    'Contributed to company\'s internal CMS development',
                ]),
                'company_url' => 'https://webcraft.studio',
                'display_order' => 2,
            ],
            [
                'user_id' => $user->id,
                'company_name' => 'Freelance',
                'position' => 'Freelance Developer',
                'employment_type' => 'freelance',
                'location' => 'Remote',
                'is_remote' => true,
                'start_date' => '2022-01-01',
                'end_date' => '2023-06-30',
                'is_current' => false,
                'description' => 'Worked with multiple clients on web development projects. Built custom WordPress themes, Laravel applications, and provided technical consulting.',
                'achievements' => json_encode([
                    'Completed 15+ freelance projects with 5-star ratings',
                    'Generated $15K+ in freelance revenue',
                    'Built long-term relationships with 5 recurring clients',
                ]),
                'company_url' => null,
                'display_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            $experience = Experience::create($exp);

            // Attach technologies to experiences
            if ($exp['company_name'] === 'TechSolutions India') {
                $experience->technologies()->attach([1, 2, 4, 6, 7, 10, 16]); // React, JS, Tailwind, PHP, Laravel, MySQL, Filament
            } elseif ($exp['company_name'] === 'WebCraft Studio') {
                $experience->technologies()->attach([1, 2, 6, 7, 10]); // React, JS, PHP, Laravel, MySQL
            } else {
                $experience->technologies()->attach([2, 6, 10]); // JS, PHP, MySQL
            }
        }

        // 7. Create Skills (User's proficiency in technologies)
        $userSkills = [
            ['technology_id' => 1, 'proficiency_percentage' => 90, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // React
            ['technology_id' => 2, 'proficiency_percentage' => 95, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // JavaScript
            ['technology_id' => 3, 'proficiency_percentage' => 75, 'years_of_experience' => 2, 'is_primary_skill' => false, 'last_used_at' => now()], // TypeScript
            ['technology_id' => 4, 'proficiency_percentage' => 92, 'years_of_experience' => 2, 'is_primary_skill' => true, 'last_used_at' => now()], // Tailwind
            ['technology_id' => 5, 'proficiency_percentage' => 70, 'years_of_experience' => 2, 'is_primary_skill' => false, 'last_used_at' => now()], // Next.js
            ['technology_id' => 6, 'proficiency_percentage' => 93, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // PHP
            ['technology_id' => 7, 'proficiency_percentage' => 95, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // Laravel
            ['technology_id' => 8, 'proficiency_percentage' => 65, 'years_of_experience' => 2, 'is_primary_skill' => false, 'last_used_at' => now()], // Node.js
            ['technology_id' => 9, 'proficiency_percentage' => 88, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // REST API
            ['technology_id' => 10, 'proficiency_percentage' => 90, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // MySQL
            ['technology_id' => 11, 'proficiency_percentage' => 60, 'years_of_experience' => 1, 'is_primary_skill' => false, 'last_used_at' => now()->subMonths(3)], // PostgreSQL
            ['technology_id' => 12, 'proficiency_percentage' => 55, 'years_of_experience' => 1, 'is_primary_skill' => false, 'last_used_at' => now()->subMonths(6)], // MongoDB
            ['technology_id' => 13, 'proficiency_percentage' => 85, 'years_of_experience' => 3, 'is_primary_skill' => true, 'last_used_at' => now()], // Git
            ['technology_id' => 14, 'proficiency_percentage' => 65, 'years_of_experience' => 1, 'is_primary_skill' => false, 'last_used_at' => now()->subMonths(2)], // Docker
            ['technology_id' => 15, 'proficiency_percentage' => 70, 'years_of_experience' => 2, 'is_primary_skill' => false, 'last_used_at' => now()], // Figma
            ['technology_id' => 16, 'proficiency_percentage' => 88, 'years_of_experience' => 2, 'is_primary_skill' => true, 'last_used_at' => now()], // Filament
        ];

        foreach ($userSkills as $index => $skill) {
            Skill::create(array_merge($skill, [
                'user_id' => $user->id,
                'display_order' => $index + 1,
            ]));
        }

        // 8. Create Certifications
        $certifications = [
            [
                'user_id' => $user->id,
                'title' => 'Laravel Certified Developer',
                'issuing_organization' => 'Laravel LLC',
                'credential_id' => 'LRV-2024-BKB-789',
                'credential_url' => 'https://certification.laravel.com/verify/LRV-2024-BKB-789',
                'issue_date' => '2024-03-15',
                'expiry_date' => null,
                'does_not_expire' => true,
                'description' => 'Official Laravel certification demonstrating advanced knowledge of the Laravel framework, best practices, and ecosystem.',
                'display_order' => 1,
            ],
            [
                'user_id' => $user->id,
                'title' => 'React Professional Developer',
                'issuing_organization' => 'Meta (Facebook)',
                'credential_id' => 'META-REACT-2023-456',
                'credential_url' => 'https://coursera.org/verify/META-REACT-2023-456',
                'issue_date' => '2023-08-20',
                'expiry_date' => null,
                'does_not_expire' => true,
                'description' => 'Meta\'s professional certification for React development, covering advanced concepts, hooks, performance optimization, and testing.',
                'display_order' => 2,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Full Stack Web Development',
                'issuing_organization' => 'Udemy',
                'credential_id' => 'UC-FULLSTACK-2022',
                'credential_url' => 'https://udemy.com/certificate/UC-FULLSTACK-2022',
                'issue_date' => '2022-12-10',
                'expiry_date' => null,
                'does_not_expire' => true,
                'description' => 'Comprehensive full-stack development course covering HTML, CSS, JavaScript, React, Node.js, and databases.',
                'display_order' => 3,
            ],
        ];

        foreach ($certifications as $cert) {
            Certification::create($cert);
        }

        // 9. Create Achievements
        $achievements = [
            [
                'user_id' => $user->id,
                'title' => 'Best Diploma Project Award 2024',
                'description' => 'Received the Best Project Award for developing an innovative E-Commerce platform during final year diploma project.',
                'awarded_by' => 'Government Polytechnic College',
                'award_date' => '2024-05-15',
                'achievement_type' => 'award',
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Inter-College Hackathon Winner',
                'description' => 'Won first prize in 24-hour coding hackathon by developing a real-time collaborative task management application.',
                'awarded_by' => 'Delhi Technical Education Board',
                'award_date' => '2023-11-20',
                'achievement_type' => 'award',
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Top Rated Freelancer',
                'description' => 'Achieved top-rated status on Upwork with 100% job success rate and 5-star average rating from 15+ clients.',
                'awarded_by' => 'Upwork',
                'award_date' => '2023-06-30',
                'achievement_type' => 'recognition',
                'is_featured' => false,
                'display_order' => 3,
            ],
        ];
        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }

        // 10. Create Services
        $services = [
            [
                'title' => 'Full Stack Web Development',
                'slug' => 'full-stack-web-development',
                'description' => 'End-to-end web application development using modern technologies like Laravel, React, and MySQL. From concept to deployment, I handle everything.',
                'pricing_type' => 'project_based',
                'starting_price' => 3000.00,
                'features' => json_encode([
                    'Custom web application development',
                    'RESTful API development',
                    'Database design and optimization',
                    'Responsive UI/UX implementation',
                    'Admin panel with Filament',
                    'Payment gateway integration',
                    'Deployment and hosting setup',
                    '30 days post-launch support',
                ]),
                'delivery_time' => '4-8 weeks',
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'E-Commerce Development',
                'slug' => 'e-commerce-development',
                'description' => 'Complete e-commerce solutions with product management, shopping cart, payment processing, and inventory management.',
                'pricing_type' => 'project_based',
                'starting_price' => 5000.00,
                'features' => json_encode([
                    'Multi-vendor marketplace support',
                    'Product catalog management',
                    'Shopping cart and checkout',
                    'Payment gateway integration',
                    'Order management system',
                    'Inventory tracking',
                    'Customer management',
                    'Sales analytics dashboard',
                ]),
                'delivery_time' => '6-10 weeks',
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'title' => 'API Development & Integration',
                'slug' => 'api-development-integration',
                'description' => 'RESTful API development, third-party API integration, and microservices architecture implementation.',
                'pricing_type' => 'hourly',
                'starting_price' => 50.00,
                'features' => json_encode([
                    'RESTful API design and development',
                    'API documentation with Swagger',
                    'Third-party API integration',
                    'Authentication & authorization (JWT, OAuth)',
                    'Rate limiting and caching',
                    'API testing and debugging',
                    'Performance optimization',
                ]),
                'delivery_time' => '2-4 weeks',
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 3,
            ],
            [
                'title' => 'Website Maintenance & Support',
                'slug' => 'website-maintenance-support',
                'description' => 'Ongoing website maintenance, bug fixes, feature updates, and technical support for existing applications.',
                'pricing_type' => 'hourly',
                'starting_price' => 40.00,
                'features' => json_encode([
                    'Bug fixes and troubleshooting',
                    'Security updates and patches',
                    'Performance optimization',
                    'Feature enhancements',
                    'Database optimization',
                    'Backup and recovery',
                    '24/7 emergency support available',
                ]),
                'delivery_time' => 'Ongoing',
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // 11. Create Social Links
        $socialLinks = [
            ['user_id' => $user->id, 'platform' => 'GitHub', 'url' => 'https://github.com/bhaskarbisht', 'username' => 'bhaskarbisht', 'is_active' => true, 'display_order' => 1],
            ['user_id' => $user->id, 'platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/bhaskarbisht', 'username' => 'bhaskarbisht', 'is_active' => true, 'display_order' => 2],
            ['user_id' => $user->id, 'platform' => 'Twitter', 'url' => 'https://twitter.com/bhaskarbisht', 'username' => '@bhaskarbisht', 'is_active' => true, 'display_order' => 3],
            ['user_id' => $user->id, 'platform' => 'Stack Overflow', 'url' => 'https://stackoverflow.com/users/bhaskarbisht', 'username' => 'bhaskarbisht', 'is_active' => true, 'display_order' => 4],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }

        // 12. Create Blog Tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'color_code' => '#FF2D20'],
            ['name' => 'React', 'slug' => 'react', 'color_code' => '#61DAFB'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'color_code' => '#3B82F6'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color_code' => '#F7DF1E'],
            ['name' => 'PHP', 'slug' => 'php', 'color_code' => '#777BB4'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color_code' => '#10B981'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // 13. Create Blog Posts
        $blogs = [
            [
                'user_id' => $user->id,
                'title' => 'Building a Modern E-Commerce Platform with Laravel and React',
                'slug' => 'building-modern-ecommerce-laravel-react',
                'excerpt' => 'Learn how to build a scalable e-commerce platform using Laravel backend and React frontend with real-world examples.',
                'body' => "# Introduction\n\nBuilding an e-commerce platform requires careful planning and the right technology stack. In this comprehensive guide, I'll walk you through building a production-ready e-commerce application.\n\n## Tech Stack\n\n- **Backend:** Laravel 11\n- **Frontend:** React 18\n- **Database:** MySQL\n- **Admin Panel:** Filament\n- **Styling:** Tailwind CSS\n\n## Key Features\n\n### Product Management\nImplementing a robust product management system with variants, inventory tracking, and bulk operations.\n\n### Payment Integration\nIntegrating Stripe and PayPal for secure payment processing.\n\n### Performance Optimization\nTechniques for optimizing database queries and implementing caching strategies.\n\n## Conclusion\n\nBuilding an e-commerce platform is challenging but rewarding. With Laravel and React, you can create a scalable and maintainable solution.",
                'reading_time' => 12,
                'status' => 'published',
                'published_at' => now()->subDays(15),
                'views_count' => 523,
                'likes_count' => 48,
                'shares_count' => 15,
                'is_featured' => true,
                'meta_title' => 'Build E-Commerce with Laravel & React - Complete Guide',
                'meta_description' => 'Step-by-step guide to building a modern e-commerce platform',
            ],
            [
                'user_id' => $user->id,
                'title' => '10 Laravel Best Practices Every Developer Should Know',
                'slug' => '10-laravel-best-practices',
                'excerpt' => 'Improve your Laravel code quality and application performance with these essential best practices and tips.',
                'body' => "# Laravel Best Practices\n\nAfter working with Laravel for 3+ years, here are the best practices I follow:\n\n## 1. Use Service Classes\nKeep controllers thin by moving business logic to service classes.\n\n## 2. Repository Pattern\nImplement repository pattern for database abstraction.\n\n## 3. Use Form Requests\nValidate incoming data using Form Request classes.\n\n## 4. Queue Long-Running Tasks\nUse Laravel queues for time-consuming operations.\n\n## 5. Optimize Database Queries\nUse eager loading to prevent N+1 query problems.\n\nAnd 5 more practices that will transform your Laravel development...",
                'reading_time' => 8,
                'status' => 'published',
                'published_at' => now()->subDays(30),
                'views_count' => 892,
                'likes_count' => 76,
                'shares_count' => 32,
                'is_featured' => true,
                'meta_title' => '10 Laravel Best Practices for Clean Code',
                'meta_description' => 'Essential Laravel best practices every developer should follow',
            ],
        ];

        foreach ($blogs as $blogData) {
            $blog = Blog::create($blogData);

            // Attach tags
            if ($blog->slug === 'building-modern-ecommerce-laravel-react') {
                $blog->tags()->attach([1, 2, 3]); // Laravel, React, Web Development
            } else {
                $blog->tags()->attach([1, 5, 6]); // Laravel, PHP, Tutorial
            }
        }

        $this->command->info('Portfolio data seeded successfully! 🚀');
        $this->command->info('Login credentials:');
        $this->command->info('Email: bhaskar@example.com');
        $this->command->info('Password: password');
    }
}
