<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col">{{ __('common.sl') }}</th>
                    <th scope="col">{{__('frontendCms.Plan')}}</th>
                    <th scope="col">{{__('frontendCms.start_price')}}</th>
                    <th scope="col">{{__('frontendCms.end_price')}}</th>
                    <th scope="col">{{ __('common.discount') }}</th>
                    <th scope="col">{{ __('common.status') }}</th>
                    <th scope="col">{{ __('common.action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($DiscountRoleList as $key => $item)
                    <tr>
                        <td>{{getNumberTranslate($key + 1)}}</td>
                        <td>{{ @$item->pricingPlan->name }}</td>
                        <td>$ {{getNumberTranslate($item->start_price) }}</td>
                        <td>$ {{getNumberTranslate($item->end_price) }}</td>
                        <td>{{getNumberTranslate($item->discount) }} %</td>
                        <td>
                            <label class="switch_toggle" for="checkbox{{ $item->id }}">
                                <input type="checkbox" id="checkbox{{ $item->id }}" {{$item->status?'checked':''}} class="statusChange" data-value="{{$item}}" value="{{$item->id}}" @if (permissionCheck('frontendcms.discount.role.status'))
                                @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td>
                            <!-- shortby  -->
                            <div class="dropdown CRM_dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('common.select') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a data-value="{{ $item }}" class="dropdown-item show_discount_role">{{ __('common.show') }}</a>
                                        <a data-value="{{ $item }}" class="dropdown-item edit_discount_role">{{ __('common.edit') }}</a>
                                        <a class="dropdown-item delete_discount_role" data-id="{{$item->id}}">{{ __('common.delete') }}</a>
                                </div>
                            </div>
                            <!-- shortby  -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
