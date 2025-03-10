<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col">{{ __('common.sl') }}</th>
                    <th scope="col">{{ __('common.name') }}</th>
                    <th scope="col">{{ __('common.image') }}</th>
                    <th scope="col">{{__('frontendCms.plan_price')}}</th>
                    <th scope="col">{{ __('common.status') }}</th>
                    <th scope="col">{{ __('common.action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($PricingPlanList as $key => $item)
                    <tr>
                        <td>{{getNumberTranslate($key + 1)}}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <img style="width: 100px; height:100;" src="{{ showImage($item->image) }}" alt="">
                        </td>
                        <td>$ {{getNumberTranslate($item->plan_price) }}</td>
                        <td>
                            <label class="switch_toggle" for="checkbox{{ $item->id }}">
                                <input type="checkbox" id="checkbox{{ $item->id }}" {{$item->status?'checked':''}} class="statusChange" data-value="{{$item}}" value="{{$item->id}}" @if (permissionCheck('frontendcms.subscription-plan.status'))
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
                                    <a target="_blank" class="dropdown-item show_discounts" href="{{ route('admin.discount.role.index', ['id' => $item->id]) }}">{{ __('common.discount') }}</a>
                                    <a data-value="{{ $item }}" class="dropdown-item show_pricing">{{ __('common.show') }}</a>
                                    @if (permissionCheck('frontendcms.subscription-plan.update'))
                                        <a data-value="{{ $item }}" class="dropdown-item edit_pricing">{{ __('common.edit') }}</a>
                                    @endif
                                    @if (permissionCheck('frontendcms.subscription-plan.delete'))
                                        <a class="dropdown-item delete_pricing" data-id="{{$item->id}}">{{ __('common.delete') }}</a>
                                    @endif
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
