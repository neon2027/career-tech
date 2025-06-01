<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalityType;
use App\Models\PersonalityQuestion;
use App\Models\Career;

class PersonalityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalities = [
            [
                'name' => 'Realistic',
                'description' => 'You like hands-on work, physical setups, and practical problem-solving with tech equipment and infrastructure.',
                'summary' => 'You’re the tech builder, the boots-on-the-ground expert. You keep networks alive, devices running, and infrastructure secure.',
                'careers' => [
                    ['name' => 'IT Support Specialist', 'description' => 'Help users solve their tech problems, both hardware and software.'],
                    ['name' => 'Network Administrator', 'description' => 'Set up and maintain the computer networks so everyone stays connected.'],
                    ['name' => 'Systems Administrator', 'description' => 'Manage servers and IT systems behind the scenes, making sure everything runs without interruptions.'],
                    ['name' => 'DevOps Engineer', 'description' => 'Build and maintain the tools and infrastructure that let software be delivered quickly and reliably.'],
                    ['name' => 'Cybersecurity Technician', 'description' => 'Protect computers and networks from cyberattacks by monitoring and fixing vulnerabilities.'],
                    ['name' => 'Cloud Operations Engineer', 'description' => 'Manage cloud platforms where companies store and run their data and apps.'],
                    ['name' => 'Field Service Technician', 'description' => 'Visit clients to install or repair physical tech equipment.'],
                    ['name' => 'Data Center Technician', 'description' => 'Take care of the physical hardware and servers in data centers.'],
                    ['name' => 'Telecom Technician', 'description' => 'Install and fix communication systems like phone lines and internet cables.'],
                    ['name' => 'Hardware Engineer', 'description' => 'Design and test new computer parts and devices.'],
                ],
                'questions' => [
                    'I enjoy assembling or repairing tech devices or equipment.',
                    'I prefer working with hardware or networking over coding.',
                    'I like using physical tools and machines in a tech lab.',
                    'I enjoy setting up servers, routers, or other tech infrastructure.',
                    'I like troubleshooting technical issues physically (e.g., cables, setups).',
                    'I prefer hands-on work over theoretical discussions in tech.',
                    'I enjoy configuring computer systems or workstations.',
                    'I feel confident setting up and maintaining office IT equipment.',
                    'I like being active and working with tech tools, not just computers.',
                    'I like seeing the physical results of tech-related tasks.',
                ],
            ],
            [
                'name' => 'Investigative',
                'description' => 'You love deep problem-solving, analytics, and building intelligent systems through research and logic.',
                'summary' => 'You’re the mind behind smart solutions—analyzing, programming, and innovating tech systems.',
                'careers' => [
                    ['name' => 'Software Developer', 'description' => 'Write code that powers websites, apps, and software tools.'],
                    ['name' => 'Data Scientist', 'description' => 'Analyze large sets of data to uncover insights and help businesses make smarter decisions.'],
                    ['name' => 'Machine Learning Engineer', 'description' => 'Build AI models that teach computers to learn from data.'],
                    ['name' => 'Cybersecurity Analyst', 'description' => 'Detect and respond to cyber threats, keeping information safe.'],
                    ['name' => 'Back-end Developer', 'description' => 'Create the server-side components and databases behind websites and apps.'],
                    ['name' => 'Cloud Solutions Architect', 'description' => 'Design scalable cloud computing environments for companies.'],
                    ['name' => 'Blockchain Developer', 'description' => 'Build secure, decentralized apps and systems.'],
                    ['name' => 'Systems Analyst', 'description' => 'Study IT systems and recommend improvements.'],
                    ['name' => 'Algorithm Engineer', 'description' => 'Develop efficient algorithms to optimize software performance.'],
                    ['name' => 'Database Administrator', 'description' => 'Organize and secure company data so it’s always available.'],
                ],
                'questions' => [
                    'I enjoy solving logic-based problems in code or data.',
                    'I like analyzing and debugging complex systems.',
                    'I enjoy working with algorithms, statistics, or data science.',
                    'I am curious about how new tech or programming languages work.',
                    'I enjoy learning and experimenting with emerging technologies.',
                    'I like reading documentation or researching how systems function.',
                    'I often question how to improve software or systems.',
                    'I enjoy working independently on technical research or experiments.',
                    'I like building proof-of-concept models or testing technical ideas.',
                    'I prefer working with facts and logic over opinions in tech work.',
                ],
            ],
            [
                'name' => 'Artistic',
                'description' => 'You’re creative, expressive, and love shaping how users experience digital products through design and innovation.',
                'summary' => 'You bring tech to life through beautiful, intuitive, and engaging designs.',
                'careers' => [
                    ['name' => 'UI Designer', 'description' => 'Craft beautiful and intuitive interfaces for websites and apps.'],
                    ['name' => 'UX Designer', 'description' => 'Research and design experiences that make digital products easy and enjoyable to use.'],
                    ['name' => 'Front-end Developer', 'description' => 'Build the part of websites and apps users see and interact with.'],
                    ['name' => 'Digital Graphic Designer', 'description' => 'Create visuals for websites, social media, and marketing.'],
                    ['name' => 'Product Designer', 'description' => 'Combine UI and UX skills to create whole digital products.'],
                    ['name' => 'Game Designer', 'description' => 'Develop game concepts, stories, and mechanics.'],
                    ['name' => 'Motion Graphics Designer', 'description' => 'Animate visuals for videos and web content.'],
                    ['name' => 'AR/VR Designer', 'description' => 'Create immersive augmented and virtual reality experiences.'],
                    ['name' => 'Content Creator (Tech Focus)', 'description' => 'Produce videos, blogs, or tutorials explaining tech topics.'],
                    ['name' => 'Multimedia Artist', 'description' => 'Blend art, sound, and tech for interactive media projects.'],
                ],
                'questions' => [
                    'I enjoy designing user interfaces or digital visuals.',
                    'I use creativity when building websites, apps, or interactive media.',
                    'I prefer flexible, open-ended tasks over rigid tech procedures.',
                    'I enjoy creating animations, mockups, or brand assets.',
                    'I like experimenting with layout, color, and typography in digital tools.',
                    'I enjoy bringing creative ideas into digital products.',
                    'I enjoy writing content or microcopy for digital experiences.',
                    'I like using motion, illustration, or 3D in design projects.',
                    'I express creativity in the way I organize and present tech solutions.',
                    'I feel energized when working on visually engaging or innovative projects.',
                ],
            ],
            [
                'name' => 'Social',
                'description' => 'You enjoy helping others understand and use technology, collaborating, and improving user experiences through communication.',
                'summary' => 'You’re the friendly guide who bridges the gap between tech and people.',
                'careers' => [
                    ['name' => 'Technical Support Specialist', 'description' => 'Help users troubleshoot and understand technology.'],
                    ['name' => 'IT Trainer', 'description' => 'Teach others how to use software and tools effectively.'],
                    ['name' => 'Customer Success Manager', 'description' => 'Make sure customers get the most out of tech products.'],
                    ['name' => 'Scrum Master', 'description' => 'Guide Agile teams to work smoothly and meet goals.'],
                    ['name' => 'Business Analyst', 'description' => 'Translate business needs into tech solutions.'],
                    ['name' => 'UX Researcher', 'description' => 'Study how users interact with technology to improve products.'],
                    ['name' => 'Technical Recruiter', 'description' => 'Find and hire the right tech talent for companies.'],
                    ['name' => 'Community Manager (Tech)', 'description' => 'Build and manage online tech user communities.'],
                    ['name' => 'Digital Literacy Coach', 'description' => 'Help people improve their tech skills and confidence.'],
                    ['name' => 'Technical Writer', 'description' => 'Create clear guides and manuals for software users.'],
                ],
                'questions' => [
                    'I enjoy helping users solve their tech issues.',
                    'I feel fulfilled when I can explain a technical concept simply.',
                    'I enjoy mentoring or teaching others how to use tools or software.',
                    'I like creating support documentation or tutorials for tech tools.',
                    'I am the person teammates ask for help with tech tasks.',
                    'I enjoy team-based tech projects and discussions.',
                    'I feel confident when presenting technical topics to a group.',
                    'I like helping clients or colleagues feel comfortable with new technology.',
                    'I care about user needs and their digital experience.',
                    'I feel motivated when I use tech to make someone’s life easier.',
                ],
            ],
            [
                'name' => 'Enterprising',
                'description' => 'You’re a natural leader who drives projects, persuades teams, and builds tech businesses or products.',
                'summary' => 'You’re the visionary who turns ideas into thriving tech ventures and teams.',
                'careers' => [
                    ['name' => 'Product Manager', 'description' => 'Lead the development and strategy of new tech products.'],
                    ['name' => 'Startup Founder', 'description' => 'Create and grow your own tech company.'],
                    ['name' => 'Digital Marketing Manager', 'description' => 'Promote tech products through online campaigns.'],
                    ['name' => 'Sales Engineer', 'description' => 'Use your tech knowledge to sell complex solutions.'],
                    ['name' => 'IT Project Manager', 'description' => 'Plan and oversee tech projects to successful completion.'],
                    ['name' => 'Tech Consultant', 'description' => 'Advise businesses on technology strategies and solutions.'],
                    ['name' => 'Business Development Manager', 'description' => 'Find new tech business opportunities and partnerships.'],
                    ['name' => 'Venture Capital Analyst', 'description' => 'Evaluate and invest in promising tech startups.'],
                    ['name' => 'Technology Evangelist', 'description' => 'Promote and educate others about new tech innovations.'],
                    ['name' => 'Innovation Manager', 'description' => 'Lead new tech initiatives and product ideas.'],
                ],
                'questions' => [
                    'I enjoy leading projects in tech, even when it’s challenging.',
                    'I like pitching digital product ideas or presenting to stakeholders.',
                    'I enjoy taking calculated risks to launch or test tech ventures.',
                    'I like selling or promoting tech tools or services.',
                    'I make decisions confidently, even in uncertain tech situations.',
                    'I enjoy public speaking or storytelling about tech ideas.',
                    'I get excited by tech competitions or hackathons.',
                    'I enjoy managing client relationships or project timelines.',
                    'I like negotiating with clients or teams on features or pricing.',
                    'I dream of starting my own tech-related business someday.',
                ],
            ],
            [
                'name' => 'Conventional',
                'description' => 'You’re detail-focused, love order and accuracy, and thrive in managing data, processes, and standards.',
                'summary' => 'You keep the tech world organized, efficient, and compliant.',
                'careers' => [
                    ['name' => 'QA Tester', 'description' => 'Test software to find bugs and ensure it works correctly.'],
                    ['name' => 'Database Administrator', 'description' => 'Manage data storage and keep it secure.'],
                    ['name' => 'IT Auditor', 'description' => 'Check systems for compliance and security.'],
                    ['name' => 'IT Operations Coordinator', 'description' => 'Manage daily IT services and resources.'],
                    ['name' => 'Documentation Specialist', 'description' => 'Write manuals and instructions for tech products.'],
                    ['name' => 'Release Manager', 'description' => 'Coordinate software updates and releases.'],
                    ['name' => 'Configuration Manager', 'description' => 'Track and control software and hardware setups.'],
                    ['name' => 'Project Coordinator (Tech)', 'description' => 'Support project managers with schedules and documentation.'],
                    ['name' => 'Data Entry Specialist', 'description' => 'Ensure accurate input and maintenance of tech data.'],
                    ['name' => 'Help Desk Coordinator', 'description' => 'Organize and streamline support ticketing and responses.'],
                ],
                'questions' => [
                    'I enjoy organizing and documenting tech processes.',
                    'I am detail-oriented when working with data or software.',
                    'I like following rules and standards in IT tasks.',
                    'I enjoy verifying software functions before release.',
                    'I prefer structured and routine work over chaotic tasks.',
                    'I like keeping records and logs of technical activities.',
                    'I enjoy coordinating schedules and managing deadlines.',
                    'I am comfortable managing multiple tasks with accuracy.',
                    'I like supporting teams by ensuring all procedures are followed.',
                    'I feel confident handling repetitive but important tech work.',
                ],
            ],
        ];

        foreach ($personalities as $personality) {
            $type = PersonalityType::create([
                'name' => $personality['name'],
                'description' => $personality['description'],
                'summary' => $personality['summary'],
            ]);
        
            foreach ($personality['careers'] as $careerData) {
                // Try to find an existing career by name
                $career = Career::where('name', $careerData['name'])->first();
        
                if (!$career) {
                    // Create new career if not found
                    $career = Career::create([
                        'name' => $careerData['name'],
                        'description' => $careerData['description'],
                        'personality_type_id' => $type->id,
                    ]);
                } else {
                    // If career exists, update the personality_type_id to link it with the current personality type
                    // (optional, depending on your business logic)
                    $career->personality_type_id = $type->id;
                    $career->save();
                }
            }
        
            foreach ($personality['questions'] as $question) {
                PersonalityQuestion::create([
                    'personality_type_id' => $type->id,
                    'question' => $question,
                ]);
            }
        }
        
    }
}
