<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class BaseModelEloquent
 */
class BaseModelEloquent extends Model
{
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $modelArray = parent::toArray();

        foreach ( $this->relations as $name => $value )
        {
            if ( !isset( $modelArray[ $name ] ) && !is_object( $value ) )
            {
                $modelArray[ $name ] = $value;
            }
        }
        if (
            isset( $this->datesWithTimeZone ) &&
            isset( $modelArray ) &&
            is_array( $this->datesWithTimeZone ) &&
            count( $this->datesWithTimeZone )
        )
        {
            foreach ( $this->datesWithTimeZone as $key )
            {
                if ( isset( $modelArray[ $key ] ) )
                {
                    if ( $modelArray[ $key ] )
                    {
                        if ( is_string( $modelArray[ $key ] ) && $modelArray[ $key ] )
                        {
                            $modelArray[ $key ] = Carbon::parse( $modelArray[ $key ], 'Asia/Tehran' )->toAtomString();
                        }
                        elseif ( is_object( $modelArray[ $key ] ) && $modelArray[ $key ] instanceof Carbon )
                        {
                            $modelArray[ $key ] = $modelArray[ $key ]->toAtomString();
                        }
                    }
                }
            }
        }

        return $modelArray;
    }
}