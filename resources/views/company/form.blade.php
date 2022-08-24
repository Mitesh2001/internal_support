<div class="card bg-secondary shadow border-0">
    <form action="{{route('company.store')}}" method="post" id="companyForm" enctype="multipart/form-data">
        @csrf
        <div class="card-header bg-transparent">
            <button type="button" class="close_button" onclick='closeHandler("#new_company")'>
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="card-title"><i class="fas fa-building"></i> New Company</h2>
            <small>When someone reaches out to you, they become a contact in your account. You can create companies and associate contacts with them.</small>
        </div>
        <div class="card-body form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="personal-image">
                        <label class="label">
                            <input type="file" name="logo" id="photoInput" accept="image/*" />
                            <figure class="personal-figure">
                                <img src="https://img.favpng.com/24/24/18/logo-building-business-house-png-favpng-CEp8CDYbYAypj7vk9D3eq8sbp.jpg" class="personal-avatar" alt="avatar">
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
                    <div class="form-group form-group-error">
                        <label for="nameInput" class="form-label text-sm">Company Name:<span class="text-danger">*</span></h5></label>
                        <input type="text" name="name" class="form-control" id="nameInput" placeholder="" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description-input" class="form-label text-sm">Description:</label>
                        <textarea name="description" class="form-control" id="description-input" placeholder="Write something that describes this company"> </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes-input" class="form-label text-sm">Notes:</label>
                        <textarea name="notes" class="form-control" id="notes-input" placeholder="Add notes about this company - maybe something about a recent deal, etc."> </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="domainsInput" class="form-label text-sm">Domains for this company:</label>
                        <input type="text" name="domains" class="form-control" id="domainsInput" placeholder="eg : mycompany1.com, mycompany.com">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="health-score-input" class="form-label text-sm">Health Score:</h5></label>
                        <select name="health_score" id="healthscore_input" class="form-control">
                            <option selected disabled value="">--</option>
                            <option value="1">At risk</option>
                            <option value="2">Doing okay</option>
                            <option value="3">Happy</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="account-tier-input" class="form-label text-sm">Account tier:</h5></label>
                        <select name="account_tier" id="accounttier_input" class="form-control">
                            <option selected disabled value="">--</option>
                            <option value="1">Basic</option>
                            <option value="2">Premium</option>
                            <option value="3">Enterprise</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="renewal-date-input" class="form-label text-sm">Renewal Date:</h5></label>
                        <input type="date" name="renewal_date" class="form-control" id="renewal-date-input">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="industry_input" class="form-label text-sm">Industry:</h5></label>
                        <select name="industry_type" id="industry_input" class="form-control">
                            @foreach (getIndustryType() as $key => $type)
                                @if ($key == 0)
                                    <option selected disabled value="">{{$type}}</option>
                                @else
                                    <option value="{{$key}}">{{$type}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-dark" onclick='closeHandler("#new_company")'>Close</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {

        $('#companyForm').validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: '{!! route('company.checkName') !!}',
                        type: "POST",
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: function () {
                                return $("#nameInput").val();
                            }
                        }
                    }
                },

            },
            messages: {
                name: {
                    required: "Name field is required !",
                    remote : "Company already Exists !"
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

        $('#healthscore_input').select2({
            width: '100%',
        });

        $('#accounttier_input').select2({
            width: '100%',
        });

    });
</script>
