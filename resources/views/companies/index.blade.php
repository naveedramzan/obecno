@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <!-- Page Header -->
                    <div class="page-header" style="margin-bottom: 32px; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 16px; box-sizing: border-box;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                            <div>
                                <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839; text-align: left;">
                                    My Companies
                                </h1>
                                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin-top: 8px; text-align: left;">
                                    Manage all your companies
                                </p>
                            </div>
                            <a href="{{ route('companies.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #2C2E33; color: #FFFFFF; text-decoration: none; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; cursor: pointer;">
                                <i class="fas fa-plus"></i>
                                Add Company
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success" style="margin-bottom: 24px; padding: 12px 16px; background-color: #D1E7DD; color: #0F5132; border-radius: 8px; border: 1px solid #BADBCC; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" style="margin-bottom: 24px; padding: 12px 16px; background-color: #F8D7DA; color: #842029; border-radius: 8px; border: 1px solid #F5C2C7; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="companies-container" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px; box-sizing: border-box;">
                        @if($companies->count() > 0)
                            <div class="companies-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                                @foreach($companies as $company)
                                    <div class="company-card" style="background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px; padding: 24px; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                                            <div style="flex: 1;">
                                                <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 18px; line-height: 1.5em; color: #192839; margin: 0 0 8px 0;">
                                                    {{ $company->title }}
                                                </h3>
                                                @if($company->founded)
                                                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861; margin: 0;">
                                                        Founded: {{ $company->founded }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="company-icon" style="width: 48px; height: 48px; border-radius: 50%; background-color: #F7F9FA; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden;">
                                                @if($company->photo)
                                                    <img src="/companies/{{ $company->id }}/{{ $company->photo }}" alt="{{ $company->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <i class="fas fa-building" style="color: #2C2E33; font-size: 20px;"></i>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if($company->description)
                                            <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.6; color: #545861; margin: 0 0 16px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $company->description }}
                                            </p>
                                        @endif

                                        <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #F7F9FA;">
                                            @if($company->website)
                                                <div style="display: flex; align-items: center; gap: 6px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 13px; color: #545861;">
                                                    <i class="fas fa-globe" style="color: #2C2E33;"></i>
                                                    <a href="{{ $company->website }}" target="_blank" style="color: #2C2E33; text-decoration: none; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        {{ Str::limit($company->website, 30) }}
                                                    </a>
                                                </div>
                                            @endif
                                            @if($company->team_size)
                                                <div style="display: flex; align-items: center; gap: 6px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 13px; color: #545861;">
                                                    <i class="fas fa-users" style="color: #2C2E33;"></i>
                                                    <span>{{ $company->team_size }} employees</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div style="display: flex; gap: 8px;">
                                            <a href="{{ route('companies.edit', $company->id) }}" style="flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; background-color: #2C2E33; color: #FFFFFF; text-decoration: none; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; transition: background-color 0.2s ease; cursor: pointer;">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state" style="text-align: center; padding: 60px 20px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px;">
                                <i class="fas fa-building" style="font-size: 48px; color: #E3E7EB; margin-bottom: 16px;"></i>
                                <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 18px; color: #192839; margin: 0 0 8px 0;">
                                    No Companies Found
                                </h3>
                                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861; margin: 0 0 24px 0;">
                                    You haven't created any companies yet. Create your first company to get started.
                                </p>
                                <a href="{{ route('companies.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #2C2E33; color: #FFFFFF; text-decoration: none; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; cursor: pointer;">
                                    <i class="fas fa-plus"></i>
                                    Create Company
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <style>
    .company-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
  </style>
@endsection

