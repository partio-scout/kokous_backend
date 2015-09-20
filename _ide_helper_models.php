<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Activity
 *
 * @property integer $id
 * @property integer $guid
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereGuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereName($value)
 */
	class Activity {}
}

namespace App{
/**
 * App\Event
 *
 * @property string $eventName
 * @property integer $id
 * @property string $date
 * @property string $time
 * @property integer $authorityId
 * @property string $place
 * @property string $activity
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereEventName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereAuthorityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereActivity($value)
 */
	class Event {}
}

namespace App{
/**
 * App\Hint
 *
 * @property integer $id
 * @property integer $activity_id
 * @property string $text
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereText($value)
 */
	class Hint {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User {}
}
