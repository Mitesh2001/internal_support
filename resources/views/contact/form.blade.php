<div class="card bg-secondary shadow border-0">
    <form action="{{route('contact.store')}}" method="post" id="contactForm" enctype="multipart/form-data">
        @csrf
        <div class="card-header bg-transparent">
            <button type="button" class="close_button" onclick="closeHandler('#new_contact')">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="card-title" id="exampleModalLabel">
                <h2><i class="fas fa-address-book"></i> New Contact</h2>
            </div>
            <small>When someone reaches out to you, they become a contact in your account. You can create companies and associate contacts with them.</small>
        </div>
        <div class="card-body form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="personal-image">
                        <label class="label">
                            <input type="file" name="profile" id="photoInput" accept="image/*" />
                            <figure class="personal-figure">
                                <img src="https://w7.pngwing.com/pngs/247/564/png-transparent-computer-icons-user-profile-user-avatar-blue-heroes-electric-blue.png" class="personal-avatar" alt="avatar">
                                <figcaption class="personal-figcaption">
                                        <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                </figcaption>
                            </figure>
                        </label>
                        <div>
                            <span class="fname"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fullNameInput" class="form-label text-sm">Full Name:<span class="text-danger">*</span></h5></label>
                        <input type="text" name="full_name" class="form-control" id="fullNameInput" placeholder="Enter a name of this person">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="titleInput" class="form-label text-sm">Title:</label>
                        <input type="text" name="title" class="form-control" id="titleInput" placeholder="Enter a title">
                    </div>
                </div>
            </div>
            <div class="card bg-secondary shadow border-0 my-3">
                <div class="card-body">
                    <h5 class="card-title">Social Media Details</h5>
                    <div class="form-group-error">
                        <input type="hidden" name="contact_details">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailInput" class="form-label text-sm">Email: <span class="text-danger">*</span> </label>
                                <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter an Email address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="work-phone-input" class="form-label text-sm">Work Phone:</label>
                                <input type="number" name="work_phone" class="form-control" id="work-phone-input" placeholder="Enter a phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mobile-phone-input" class="form-label text-sm">Mobile Phone:</label>
                                <input type="number" name="mobile_number" class="form-control" id="mobile-phone-input" placeholder="Enter a phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="twitter-id-input" class="form-label text-sm">Twitter:</label>
                                <input type="text" name="twitter_id" class="form-control" id="twitter-id-input" placeholder="Enter a Twitter ID">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="external-id-input" class="form-label text-sm">Unique external ID:</label>
                                <input type="text" name="external_id" class="form-control" id="external-id-input" placeholder="Enter the contact's unique ID">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="company-id-input" class="form-label text-sm">Company:</label>
                        <select name="company_id" class="form-control" id="company_input">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address-input" class="form-label text-sm">Address:</label>
                        <textarea name="address" class="form-control" id="address-input" placeholder="Enter the address of this person"> </textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="language-input" class="form-label text-sm">Language:</label>
                        <select name="language_id" id="language-input">
                            @foreach (getLanguageList() as $key => $language)
                                <option value="{{$key}}">{{$language}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="about-input" class="form-label text-sm">About:</label>
                        <textarea name="about" class="form-control" id="about-input" placeholder="Enter some text"> </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-dark" onclick="closeHandler('#new_contact')">Close</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {

        $('#contactForm').validate({
            rules: {
                full_name: {
                    required: true,
                },
                email : {
                    required: true,
                    remote: {
                        url: '{!! route('contact.checkEmail') !!}',
                        type: "POST",
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: function () {
                                return $("#emailInput").val();
                            }
                        }
                    }
                }
            },
            messages: {
                full_name: {
                    required: "Name field is required !",
                },
                email : {
                    required: "Email field is required !",
                    remote: "Email already Exists !"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#company_input').select2({
            width: '100%',
            placeholder: "Select Company",
            allowClear: true,
            ajax: {
                url: '{!! route('company.get_companies') !!}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache : true
            }
        });

        $('#language-input').select2({
            width: '100%',
            placeholder: "Select Language",
        });

    });
</script>
