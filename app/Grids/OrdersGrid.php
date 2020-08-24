<?php

namespace App\Grids;

use App\Traits\UtilsTrait;
use Closure;
use Leantony\Grid\Grid;
use Modules\Store\Entities\Order;

class OrdersGrid extends Grid implements OrdersGridInterface
{
    use UtilsTrait;

    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'orders';

    /**
     * List of buttons to be generated on the grid
     *
     * @var array
     */
    protected $buttonsToGenerate = [
//        'create',
        'view',
        'delete',
        'refresh',
        'export'
    ];

    /**
     * Specify if the rows on the table should be clicked to navigate to the record
     *
     * @var bool
     */
    protected $linkableRows = false;

    /**
     * Set the columns to be displayed.
     *
     * @return void
     * @throws \Exception if an error occurs during parsing of the data
     */
    public function setColumns()
    {
        $this->columns = [
            "id" => [
                "label" => "ID",
                "filter" => [
                    "enabled" => false,
                    "operator" => "="
                ],
                "styles" => [
                    "column" => "grid-w-10"
                ]
            ],
            "created_at" => [
                "sort" => false,
                "date" => true,
                "filter" => [
                    "enabled" => true,
                    "type" => "daterange",
//                    "operator" => "<="
                ],
            ],
            "userId" => [
                "label" => "Client",
                "search" => [
                    "enabled" => true
                ],
                "filter" => [
                    "enabled" => true,
                    "operator" => "="
                ],
                'presenter' => function ($columnData, $columnName) {
                    return $columnData->getClient()->fullname();
                }
            ],
            "phone" => [
                "label" => "Phone",
                "search" => [
                    "enabled" => true,
                    "useFilterQuery" => true
                ],
                "filter" => [
                    "enabled" => true,
                    "query" => function ($query, $columnName, $userInput) {
                        return $query->whereHas("getClientModel", function ($query) use ($userInput) {
                            return $query->where("phone", "like", "%" . $userInput . "%");
                        });
                    }
                ],
                'presenter' => function ($columnData, $columnName) {
                    return $columnData->getClient()->phone;
                }
            ],

            "status" => [
                "search" => [
                    "enabled" => true
                ],
                "filter" => [
                    "enabled" => true,
                    'type' => 'select',
                    'data' => (new Order())->getAvailableStatuses()
                ]
            ],
            "price" => [
                "search" => [
                    "enabled" => true
                ],
                "filter" => [
                    "enabled" => true,
                    "operator" => "="
                ],
                'presenter' => function ($columnData, $columnName) {
                    return $this->intToFloat($columnData->price) . ' ' . $columnData->currency;
                }
            ],
            "paymentMethod" => [
                "search" => [
                    "enabled" => true
                ],
                'presenter' => function ($columnData, $columnName) {
                    return __(ucfirst($columnData->paymentMethod));
                },
                "filter" => [
                    "enabled" => true,
                    'type' => 'select',
                    'data' => [
                        'cashOnDelivery' => __('Cash on delivery'),
                        'cart' => __('Cart'),
                    ]
                ]
            ]
        ];
    }

    /**
     * Set the links/routes. This are referenced using named routes, for the sake of simplicity
     *
     * @return void
     */
    public function setRoutes()
    {
        // searching, sorting and filtering
        $this->setIndexRouteName('orders.index');

        // crud support
        $this->setCreateRouteName('orders.create');
        $this->setViewRouteName('orders.edit');
        $this->setDeleteRouteName('orders.destroy');

        // default route parameter
        $this->setDefaultRouteParameter('id');
    }

    /**
     * Return a closure that is executed per row, to render a link that will be clicked on to execute an action
     *
     * @return Closure
     */
    public function getLinkableCallback(): Closure
    {
        return function ($gridName, $item) {
            return route($this->getViewRouteName(), [$gridName => $item->id]);
        };
    }

    /**
     * Configure rendered buttons, or add your own
     *
     * @return void
     */
    public function configureButtons()
    {
        // call `addRowButton` to add a row button
        // call `addToolbarButton` to add a toolbar button
        // call `makeCustomButton` to do either of the above, but passing in the button properties as an array

        // call `editToolbarButton` to edit a toolbar button
        // call `editRowButton` to edit a row button
        // call `editButtonProperties` to do either of the above. All the edit functions accept the properties as an array
    }

    /**
     * Returns a closure that will be executed to apply a class for each row on the grid
     * The closure takes two arguments - `name` of grid, and `item` being iterated upon
     *
     * @return Closure
     */
    public function getRowCssStyle(): Closure
    {
        return function ($gridName, $item) {
            return $item->getStatusClass();
        };
    }
}
