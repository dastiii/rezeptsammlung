<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Recipe extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Recipe::class;

    public function title()
    {
        return $this->title . ' ' . $this->subtitle;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'subtitle',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Avatar::make(__('Photo'), 'photo')
                ->disk('recipe-photos')
                ->squared(),
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Title'), 'title')->sortable(),
            Text::make(__('Subtitle'), 'subtitle')->sortable(),
            Textarea::make(__('Preparation'), 'preparation'),
            Number::make(__('Cooking Time'), 'cooking_time'),
            Number::make(__('Servings'), 'servings'),
            Number::make(__('Total Kcal'), 'total_kcal'),

            BelongsToMany::make('Ingredients')->fields(function ($request, $relatedModel) {
                return [
                    Text::make('Amount', function () use ($relatedModel) {
                        return $relatedModel?->pivot?->amount . ' ' . $relatedModel?->pivot?->unit;
                    })
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                    Number::make('amount')->onlyOnForms(),
                    Text::make('Unit')->onlyOnForms(),
                    Text::make('Note'),
                ];
            })->searchable(),

            HasMany::make('Steps'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
