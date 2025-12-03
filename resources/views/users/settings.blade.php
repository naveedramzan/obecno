@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="page-header" style="margin-bottom: 32px; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 16px; box-sizing: border-box;">
                        <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839;">
                            Settings
                        </h1>
                        <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin-top: 8px;">
                            Manage your company settings and modules
                        </p>
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

                    <div class="settings-container" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px; box-sizing: border-box;">
                        <div class="settings-card" style="width: 100%; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px; padding: 32px; box-sizing: border-box;">
                            
                            <div class="company-info" style="margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid #E3E7EB;">
                                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 20px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                    Company: {{ $defaultCompany->title }}
                                </h2>
                                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.5em; color: #545861;">
                                    Configure your company settings and manage available modules
                                </p>
                            </div>

                            <form method="POST" action="{{ route('settings.update') }}" id="settingsForm">
                                @csrf
                                
                                <!-- Available Modules Section (Collapsible) -->
                                <div class="settings-section" style="width: 100%; margin-bottom: 24px; border: 1px solid #E3E7EB; border-radius: 8px; overflow: hidden; box-sizing: border-box;">
                                    <div class="section-header" 
                                         id="modulesSectionHeader"
                                         onclick="toggleSection('modulesSection')"
                                         style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background-color: #F7F9FA; cursor: pointer; transition: background-color 0.2s ease;">
                                        <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 18px; line-height: 1.5em; color: #192839; margin: 0;">
                                            Available Modules
                                        </h3>
                                        <i class="fas fa-chevron-down section-arrow" 
                                           id="modulesSectionArrow"
                                           style="color: #545861; font-size: 14px; transition: transform 0.3s ease; transform: rotate(180deg);"></i>
                                    </div>
                                    
                                    <div class="section-content" id="modulesSection" style="display: block; padding: 20px; width: 100%; box-sizing: border-box;">
                                        @if($modules->count() > 0)
                                            <div class="modules-accordion" id="modulesAccordion">
                                                @foreach($modules as $index => $module)
                                                    <div class="module-item" style="margin-bottom: 12px; border: 1px solid #E3E7EB; border-radius: 8px; overflow: hidden;">
                                                        <div class="module-header" 
                                                             style="display: flex; align-items: center; justify-content: space-between; padding: 16px; background-color: #F7F9FA; cursor: pointer; transition: background-color 0.2s ease;"
                                                             onclick="toggleModule('module-{{ $module->id }}')">
                                                            <div style="display: flex; align-items: center; gap: 12px; flex: 1;">
                                                                <input type="checkbox" 
                                                                       name="modules[]" 
                                                                       value="{{ $module->id }}" 
                                                                       id="module-checkbox-{{ $module->id }}"
                                                                       {{ in_array($module->id, $enabledModuleIds) ? 'checked' : '' }}
                                                                       onclick="event.stopPropagation();"
                                                                       style="width: 18px; height: 18px; cursor: pointer; accent-color: #0ED574;">
                                                                <label for="module-checkbox-{{ $module->id }}" 
                                                                       style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px; line-height: 1.5em; color: #192839; cursor: pointer; margin: 0; flex: 1;"
                                                                       onclick="event.stopPropagation();">
                                                                    {{ $module->title }}
                                                                </label>
                                                            </div>
                                                            <i class="fas fa-chevron-down module-arrow" 
                                                               id="arrow-{{ $module->id }}"
                                                               style="color: #545861; font-size: 14px; transition: transform 0.3s ease; transform: rotate(0deg);"></i>
                                                        </div>
                                                        <div class="module-content" 
                                                             id="module-{{ $module->id }}"
                                                             style="display: none; padding: 16px; background-color: #FFFFFF; border-top: 1px solid #E3E7EB;">
                                                            <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.5em; color: #545861; margin: 0;">
                                                                Enable this module to access {{ strtolower($module->title) }} features for your company.
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="padding: 24px; text-align: center; background-color: #F7F9FA; border-radius: 8px;">
                                                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin: 0;">
                                                    No modules available at the moment.
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Company Settings Section (Collapsible) -->
                                <div class="settings-section" style="width: 100%; margin-bottom: 24px; border: 1px solid #E3E7EB; border-radius: 8px; overflow: hidden; box-sizing: border-box;">
                                    <div class="section-header" 
                                         id="companySettingsSectionHeader"
                                         onclick="toggleSection('companySettingsSection')"
                                         style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background-color: #F7F9FA; cursor: pointer; transition: background-color 0.2s ease;">
                                        <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 18px; line-height: 1.5em; color: #192839; margin: 0;">
                                            Company Settings
                                        </h3>
                                        <i class="fas fa-chevron-down section-arrow" 
                                           id="companySettingsSectionArrow"
                                           style="color: #545861; font-size: 14px; transition: transform 0.3s ease; transform: rotate(0deg);"></i>
                                    </div>
                                    
                                    <div class="section-content" id="companySettingsSection" style="display: none; padding: 20px; width: 100%; box-sizing: border-box;">
                                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                            <!-- Check In Time -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Check In Time
                                                </label>
                                                <input type="time" 
                                                       name="check_in_time" 
                                                       value="{{ old('check_in_time', $companySettings->check_in_time ?? '') }}"
                                                       style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                            </div>

                                            <!-- Check Out Time -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Check Out Time
                                                </label>
                                                <input type="time" 
                                                       name="check_out_time" 
                                                       value="{{ old('check_out_time', $companySettings->check_out_time ?? '') }}"
                                                       style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                            </div>

                                            <!-- Grace Period -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Grace Period
                                                </label>
                                                <select name="grace_period" 
                                                        style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839; background-color: #FFFFFF;">
                                                    <option value="">Select Grace Period</option>
                                                    <option value="no-grace" {{ old('grace_period', $companySettings->grace_period ?? '') == 'no-grace' ? 'selected' : '' }}>No Grace</option>
                                                    <option value="5-min" {{ old('grace_period', $companySettings->grace_period ?? '') == '5-min' ? 'selected' : '' }}>5 minutes</option>
                                                    <option value="10-min" {{ old('grace_period', $companySettings->grace_period ?? '') == '10-min' ? 'selected' : '' }}>10 minutes</option>
                                                    <option value="15-min" {{ old('grace_period', $companySettings->grace_period ?? '') == '15-min' ? 'selected' : '' }}>15 minutes</option>
                                                    <option value="30-min" {{ old('grace_period', $companySettings->grace_period ?? '') == '30-min' ? 'selected' : '' }}>30 minutes</option>
                                                </select>
                                            </div>

                                            <!-- Break Time -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Break Time (minutes)
                                                </label>
                                                <input type="number" 
                                                       name="break_time" 
                                                       value="{{ old('break_time', $companySettings->break_time ?? '') }}"
                                                       min="0"
                                                       style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                            </div>

                                            <!-- Calendar Country -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Calendar Country
                                                </label>
                                                <select name="calendar_country_id" 
                                                        style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839; background-color: #FFFFFF;">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ old('calendar_country_id', $companySettings->calendar_country_id ?? '') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Year Start Date -->
                                            <div class="form-field">
                                                <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                    Year Start Date
                                                </label>
                                                <input type="date" 
                                                       name="year_start_date" 
                                                       value="{{ old('year_start_date', @$companySettings->year_start_date ? $companySettings->year_start_date->format('Y-m-d') : '') }}"
                                                       style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                            </div>
                                        </div>

                                        <!-- Working Days -->
                                        <div class="form-field" style="margin-top: 20px;">
                                            <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 12px;">
                                                Working Days
                                            </label>
                                            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                                                @php
                                                    $workingDays = old('working_days', $companySettings->working_days ?? []);
                                                    $days = ['mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thr' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday'];
                                                @endphp
                                                @foreach($days as $key => $day)
                                                    <label style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; background-color: #F7F9FA; border: 1px solid #E3E7EB; border-radius: 8px; cursor: pointer; transition: all 0.2s ease;">
                                                        <input type="checkbox" 
                                                               name="working_days[]" 
                                                               value="{{ $key }}"
                                                               {{ in_array($key, $workingDays) ? 'checked' : '' }}
                                                               style="width: 18px; height: 18px; cursor: pointer; accent-color: #0ED574;">
                                                        <span style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #192839;">{{ $day }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Leave Types -->
                                        <div style="margin-top: 32px;">
                                            <h4 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px; line-height: 1.5em; color: #192839; margin-bottom: 16px;">
                                                Leave Types
                                            </h4>
                                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Casual Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="casual_leaves" 
                                                           value="{{ old('casual_leaves', $companySettings->casual_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Sick Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="sick_leaves" 
                                                           value="{{ old('sick_leaves', $companySettings->sick_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Emergency Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="emergency_leaves" 
                                                           value="{{ old('emergency_leaves', $companySettings->emergency_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Maternity Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="maternity_leaves" 
                                                           value="{{ old('maternity_leaves', $companySettings->maternity_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Paternity Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="paternity_leaves" 
                                                           value="{{ old('paternity_leaves', $companySettings->paternity_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Bereavement Leave
                                                    </label>
                                                    <input type="number" 
                                                           name="bereavement_leave" 
                                                           value="{{ old('bereavement_leave', $companySettings->bereavement_leave ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>

                                                <div class="form-field">
                                                    <label style="display: block; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                                        Compensation Leaves
                                                    </label>
                                                    <input type="number" 
                                                           name="compensation_leaves" 
                                                           value="{{ old('compensation_leaves', $companySettings->compensation_leaves ?? '') }}"
                                                           min="0"
                                                           style="width: 100%; padding: 12px 16px; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 15px; color: #192839;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-actions" style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #E3E7EB; display: flex; gap: 12px; justify-content: flex-end;">
                                    <button type="submit" 
                                            style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #0ED574; color: #FFFFFF; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; cursor: pointer; transition: background-color 0.2s ease;">
                                        <i class="fas fa-save"></i>
                                        Save Settings
                                    </button>
                                    <a href="{{ route('dashboard') }}" 
                                       style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #F7F9FA; color: #192839; text-decoration: none; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease;">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script>
    // Toggle section (for collapsible sections like Available Modules)
    function toggleSection(sectionId) {
        const content = document.getElementById(sectionId);
        const arrow = document.getElementById(sectionId + 'Arrow');
        
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            if (arrow) {
                arrow.style.transform = 'rotate(180deg)';
            }
        } else {
            content.style.display = 'none';
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    }

    // Toggle module accordion
    function toggleModule(moduleId) {
        const content = document.getElementById(moduleId);
        const arrow = document.getElementById('arrow-' + moduleId.replace('module-', ''));
        
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            arrow.style.transform = 'rotate(180deg)';
        } else {
            content.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        }
    }

    // Auto-expand modules that are enabled
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="modules[]"]:checked');
        checkboxes.forEach(function(checkbox) {
            const moduleId = checkbox.value;
            const content = document.getElementById('module-' + moduleId);
            const arrow = document.getElementById('arrow-' + moduleId);
            
            if (content) {
                content.style.display = 'block';
            }
            if (arrow) {
                arrow.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Form submission handler
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="modules[]"]:checked');
        
        if (checkboxes.length === 0) {
            if (!confirm('No modules selected. This will disable all modules for your company. Continue?')) {
                e.preventDefault();
                return false;
            }
        }
    });
  </script>

  <style>
    /* Ensure stable layout */
    .settings-container {
        width: 100% !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        box-sizing: border-box !important;
    }

    .settings-card {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .settings-section {
        width: 100% !important;
        box-sizing: border-box !important;
        transition: box-shadow 0.2s ease;
    }

    .section-content {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .section-header {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .section-header:hover {
        background-color: #E9EBEF !important;
    }

    .module-header:hover {
        background-color: #E9EBEF !important;
    }

    .module-item {
        transition: box-shadow 0.2s ease;
        width: 49%;
        float:left;
        text-align: left;
        box-sizing: border-box;
    }

    .module-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .settings-section:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    button[type="submit"]:hover {
        background-color: #0BC965 !important;
    }

    a[href="{{ route('dashboard') }}"]:hover {
        background-color: #E9EBEF !important;
    }

    /* Ensure form fields maintain width */
    .form-field {
        width: 100%;
        box-sizing: border-box;
    }

    .form-field input,
    .form-field select {
        width: 100% !important;
        box-sizing: border-box !important;
    }
  </style>
@endsection

