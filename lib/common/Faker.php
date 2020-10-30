<?php

namespace Common;
use \Faker\Factory;
use \Faker\Generator;

class Faker extends Generator {

	public static function random($input = 6) {
		$faker = Factory::create();

		if (is_array($input)) {
			return $faker->randomElement($input);
		} else {
			return $faker->randomNumber($input);
		}
	}

	public static function address($include_extra = false) {
		$faker = Factory::create();

		$add_number = $faker->randomNumber(4);
        $add_directional = $faker->randomElement(['N', 'S', 'W', 'E']);
        $add_street = $faker->streetName;
        $add_street_suffix = $faker->streetSuffix;
        $unit_number = $faker->buildingNumber;
        $unit_designator = $faker->randomElement(['BLDG', 'TRLR', 'FL', 'HTS']);

		$address = [
			'street_1' => $add_number.' '.$add_directional.' '.$add_street.' '.$add_street_suffix,
			'street_2' => $unit_designator.' '.$unit_number,
			'city' => $faker->city,
			'state' => $faker->stateAbbr,
			'zip' => $faker->postcode,
			'type' => $faker->randomElement(['Residential', 'Business', 'POE', 'Appartment'])
		];

		if ($include_extra) {
			$address = array_merge($address, [
				'street_number' => $add_number,
				'street_name' => $add_street,
				'unit_designator' => $unit_designator,
				'unit_number' => $unit_number,
				'street_suffix' => $add_street_suffix,
				'directional' => $add_directional
			]);
		}

		return $address;
	}

	public static function email() {
		$faker = Factory::create();
		return $faker->email;
	}

	public static function user() {
		$faker = Factory::create();

		return [
			'username' => $faker->userName,
			'firstname' => $faker->firstName,
			'lastname' => $faker->lastName,
			'email' => $faker->email
		];
	}
}