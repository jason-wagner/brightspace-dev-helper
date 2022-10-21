<?php

namespace BrightspaceDevHelper\Valence\Block;

use BrightspaceDevHelper\Valence\BlockArray\SocialMediaUrls;
use BrightspaceDevHelper\Valence\Structure\Block;

class UserProfile extends Block
{
	public string $NickName;
	public Birthday $Birthday;
	public string $Hometown;
	public string $Email;
	public string $HomePage;
	public string $HomePhone;
	public string $BusinessPhone;
	public string $MobilePhone;
	public string $FaxNumber;
	public string $Address1;
	public string $Address2;
	public string $City;
	public string $Province;
	public string $PostalCode;
	public string $Country;
	public string $Company;
	public string $JobTitle;
	public string $HighSchool;
	public string $University;
	public string $Hobbies;
	public string $FavMusic;
	public string $FavTVShows;
	public string $FavMovies;
	public string $FavBooks;
	public string $FavQuotations;
	public string $FavWebSites;
	public string $FutureGoals;
	public string $FavMemory;
	public SocialMediaUrls $SocialMediaUrls;
	public string $ProfileIdentifier;

	public function __construct(array $response)
	{
		parent::__construct($response, ['Birthday', 'SocialMediaUrls']);
		$this->Birthday = new Birthday($response['Birthday']);
		$this->SocialMediaUrls = new SocialMediaUrls($response['SocialMediaUrls']);
	}
}
