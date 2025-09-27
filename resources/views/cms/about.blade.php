@extends('layout')
@section('content')
   
  <section>
    <!-- Swiper-->
    <div class="fluid-container" style="background:url('front/images/header-bg.png'); background-size: cover; height:150px; width:100%;">
      <div class="container">
        <div class="row">
            <div class="col-lg-12 heading">
                <h2>About Us</h2>
            </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <!-- Swiper-->
    <div class="container">
        <div class="row cms">
            <h3>About {{ allSettings()['siteTitle']  }}</h3>
            <p><b>{{ allSettings()['siteTitle']  }}</b> was founded by Naveed Ramzan, an experienced IT professional with nearly two decades of expertise in software development, project management, and business architecture. Over the course of his career, Naveed has worked extensively across various industries, including healthcare, eCommerce, and ERP systems, serving clients globally in regions like the USA, Canada, UK, and Pakistan.</p>
            <p>With a deep understanding of the growing challenges organizations face in managing appointments and schedules, Naveed initiated {{ allSettings()['siteTitle']  }} as a SaaS platform to deliver a seamless, intuitive solution for businesses worldwide. His mission is to simplify scheduling for all industries, from healthcare to professional services, by offering a reliable, scalable, and compliance-ready product that enhances operational efficiency.</p>
            <p>As the Head of Engineering at 31 Green—a company providing ERP solutions and healthcare services—Naveed has successfully led multi-functional teams and large-scale projects across healthcare systems complying with HIPAA, NHS, and GDPR standards. Drawing from this experience, he has developed {{ allSettings()['siteTitle']  }} to be more than just a scheduling tool—it's a comprehensive solution designed to sync with the evolving needs of modern businesses.</p>

            <h3>Naveed Ramzan's Background</h3>
            <p><b>Career Beginnings</b>: Naveed began his journey in software development in 2006, progressing from PHP developer to Senior Developer, Team Lead, and Technical Lead. His early work focused on providing end-to-end solutions, meeting deployment needs, and ensuring seamless client experiences.</p>
            <p><b>Global Expertise</b>: Over the years, Naveed has worked with international companies like Troon Technologies (Canada), Smart Storm Industries (USA), and Agility Whiz (USA/PK). His roles involved business architect design, project management, and integration of advanced systems, which paved the way for developing SaaS-based solutions.</p>
            <p><b>Healthcare Focus</b>: For the past decade, Naveed has specialized in healthcare IT, focusing on systems that comply with stringent regulatory standards like HIPAA and NHS. His work in telemedicine and appointment scheduling directly inspired the creation of {{ allSettings()['siteTitle']  }} to meet the complex needs of global healthcare organizations and other industries alike.</p>
            <p><b>With {{ allSettings()['siteTitle']  }}</b>, Naveed Ramzan aims to provide an unparalleled solution for managing appointments and time, serving businesses of all sizes across diverse industries with global scalability and compliance as the cornerstones of the platform.</p>
        </div>
    </div>
  </section>
@endsection