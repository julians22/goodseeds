<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::take(5)->get();
        $teams = Team::take(5)->get();

        // make dummy posts
        $posts = [
            [
                'title' => 'Consulting Services',
                'image' => asset('1doing.jpg'),
                'content' => 'We offer customized consulting to address your specific
                                challenges and goals, including:
                                <ul>
                                    <li>Strategic planning</li>
                                    <li>Business & organizational development</li>
                                    <li>System development & implementation</li>
                                    <li>Change management</li>
                                </ul>',
            ],
            [
                'title' => 'Coaching and Mentoring',
                'image' => asset('2doing.jpg'),
                'content' => 'Our one-on-one coaching and mentoring services guide
                        business owners and key personnel through the
                        transformation journey, helping them reach their full
                        potential and optimum performance.'
            ],
            [
                'title' => 'Training Programs',
                'image' => asset('3doing.jpg'),
                'content' => 'Our training programs enhance workforce skills and
                                capabilities, including:
                                <ul>
                                    <li>Leadership Development program</li>
                                    <li>Management Trainee program</li>
                                    <li>B2B Consultative Sales</li>
                                    <li>Soft skills training such as : Vision & Growth
                                        Mindset, Effective Communication & Influencing,
                                        Problem Solving & Decision Making & Impactful
                                        Presentation Skills
                                    </li>
                                </ul>
                                Mindset, Effective Communication & Influencing,
                                Problem Solving & Decision Making & Impactful
                                Presentation Skills',
            ],
            [
                'title' => 'Recruitment Services',
                'image' => asset('4doing.jpg'),
                'content' => 'We help you attract and retain top talent. Our strategic
                        approach ensures candidates not only have the right
                        skills and experience but also fit your company culture,
                        driving your business forward.'
            ]
        ];

        return view('welcome', compact('banners', 'posts', 'teams'));
    }
}
