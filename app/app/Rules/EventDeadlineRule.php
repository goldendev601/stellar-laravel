<?php

namespace App\Rules;

use App\ModelsExtended\Asset;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class EventDeadlineRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return string
     */
    protected $deadlineDate;

    public function __construct($deadlineDate)
    {
        $this->deadlineDate = $deadlineDate;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $formatDeadlineDate = Asset::format_date($this->deadlineDate);
        $formatDate = Asset::format_date($value);
        return (Carbon::parse($formatDate)->gt(Carbon::parse($formatDeadlineDate)) || Carbon::parse($formatDate)->eq(Carbon::parse($formatDeadlineDate)));

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be greater date and time of deadline.';
    }
}
