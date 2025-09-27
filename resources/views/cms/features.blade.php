@extends('layout')
@section('content')
   
  <section>
    <!-- Swiper-->
    <div class="fluid-container" style="background:url('front/images/header-bg.png'); background-size: cover; height:150px; width:100%;">
      <div class="container">
        <div class="row">
            <div class="col-lg-12 heading">
                <h2>Product Features</h2>
            </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <!-- Swiper-->
    <div class="container">
        <div class="row">
            <div class="feature odd">
                <h4>Real-Time Scheduling & Syncing</h4>
                <ul class="col-sm-3 col-lg-8">
                    <li>Automatically syncs appointments, meetings, and bookings across different devices, time zones, and platforms.</li>
                    <li>Integrates with popular calendar tools like Google Calendar, Outlook, and iCal for seamless scheduling.</li>
                </ul>
                <img src="front/images/features/real-time-scheduling-sync.png" class="col-sm-3">
            </div>  
            
            <div class="feature even">
                <h4>Customizable Appointment Categories/Services</h4>
                <ul class="col-sm-3 col-lg-8">
                    <li>Set up various appointment categories/services (e.g., consultation, meeting, demo, interview) with flexible time slots and durations.</li>
                    <li>Tailor appointments based on the business needs, whether for individuals, teams, or customer meetings.</li>
                </ul>
                <img src="front/images/features/customizable-appointment-categories-services.png" class="col-sm-3">
            </div>  

            <div class="feature odd">
                <h4>Automated Notifications & Reminders</h4>
                <ul class="col-sm-3 col-lg-8">
                    <li>Sends out automatic SMS, email, and push notifications to remind participants of upcoming appointments.</li>
                    <li>Reduces no-shows and last-minute cancellations by keeping everyone informed with customizable reminders.</li>
                </ul>
                <img src="front/images/features/automated-notifications-and-reminders.png" class="col-sm-3">
            </div>  

            <div class="feature even">
                <h4>Multi-User & Multi-Location Support</h4>
                <ul class="col-sm-3 col-lg-8">
                    <li>Supports businesses with multiple locations, teams, or departments to manage their schedules under one platform.</li>
                    <li>Allows users to switch between different providers, locations, or team members while booking or managing appointments.</li>
                </ul>
                <img src="front/images/features/multi-user-multi-location-support.png" class="col-sm-3">
            </div>  
            
            <div class="feature odd">
                <h4>Analytics & Reporting</h4>
                <ul class="col-sm-3 col-lg-8">
                    <li>Offers insights into appointment trends, no-show rates, peak booking times, and resource utilization.</li>
                    <li>Provides detailed reports to help businesses optimize scheduling, manage workloads, and improve efficiency.</li>
                </ul>
                <img src="front/images/features/analytics-and-reporting.png" class="col-sm-3">
            </div>  
            <div class="feature">
                <h3>Product Roadmap</h3>
                <h5>Phase 1: Launch (Q4 2024)</h5>
                <ul>
                    <li>Core Features: Real-time scheduling, multi-platform syncing, customizable appointment types, and multi-user/location support.</li>
                    <li>Initial Industries: Focus on healthcare and professional services (law, consulting, finance).</li>
                    <li>Compliance: Integrated with region-specific privacy laws (HIPAA, GDPR, PIPEDA).</li>
                </ul>
                
                <h5>Phase 2: Expansion (Q1-Q2 2025)</h5>
                <ul>
                    <li>Integrations: Integration with CRM systems, telemedicine platforms, and payment gateways.</li>
                    <li>API Availability: Public API to allow businesses to connect ScheduleSync with their internal systems.</li>
                    <li>Industry Expansion: Rollout to retail, hospitality, and education sectors.</li>
                </ul>

                <h5>Phase 3: Advanced Features (Q3-Q4 2025)</h5>
                <ul>
                    <li>AI-Powered Scheduling: Implementation of AI to suggest optimal meeting times, based on availability and preferences.</li>
                    <li>Machine Learning: Use of ML to predict appointment cancellations, overbooking trends, and optimize resource allocation.</li>
                    <li>International Localization: Support for multiple languages, currencies, and region-specific customizations.</li>
                </ul>

                <h5>Phase 4: Global Scaling (2026 Onwards)</h5>
                <ul>
                    <li>Enterprise-Level Customization: Tailored solutions for large organizations with more complex scheduling needs.</li>
                    <li>Global Partnerships: Collaboration with healthcare and service organizations in new regions, expanding the user base globally.</li>
                    <li>Mobile App Enhancements: Continued upgrades to mobile apps for on-the-go scheduling and notifications.</li>
                </ul>
            </div>
        </div>
    </div>
  </section>
@endsection