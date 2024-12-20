<?php
/**
 * Schema types configuration.
 *
 * @package HivePress\Configs
 */

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'3DModel' => '3DModel',
	'AMRadioChannel' => 'AMRadioChannel',
	'APIReference' => 'APIReference',
	'AboutPage' => 'AboutPage',
	'AcceptAction' => 'AcceptAction',
	'Accommodation' => 'Accommodation',
	'AccountingService' => 'AccountingService',
	'AchieveAction' => 'AchieveAction',
	'Action' => 'Action',
	'ActionAccessSpecification' => 'ActionAccessSpecification',
	'ActionStatusType' => 'ActionStatusType',
	'ActivateAction' => 'ActivateAction',
	'AddAction' => 'AddAction',
	'AdministrativeArea' => 'AdministrativeArea',
	'AdultEntertainment' => 'AdultEntertainment',
	'AdvertiserContentArticle' => 'AdvertiserContentArticle',
	'AggregateOffer' => 'AggregateOffer',
	'AggregateRating' => 'AggregateRating',
	'AgreeAction' => 'AgreeAction',
	'Airline' => 'Airline',
	'Airport' => 'Airport',
	'AlignmentObject' => 'AlignmentObject',
	'AllocateAction' => 'AllocateAction',
	'AmpStory' => 'AmpStory',
	'AmusementPark' => 'AmusementPark',
	'AnalysisNewsArticle' => 'AnalysisNewsArticle',
	'AnatomicalStructure' => 'AnatomicalStructure',
	'AnatomicalSystem' => 'AnatomicalSystem',
	'AnimalShelter' => 'AnimalShelter',
	'Answer' => 'Answer',
	'Apartment' => 'Apartment',
	'ApartmentComplex' => 'ApartmentComplex',
	'AppendAction' => 'AppendAction',
	'ApplyAction' => 'ApplyAction',
	'ApprovedIndication' => 'ApprovedIndication',
	'Aquarium' => 'Aquarium',
	'ArchiveComponent' => 'ArchiveComponent',
	'ArchiveOrganization' => 'ArchiveOrganization',
	'ArriveAction' => 'ArriveAction',
	'ArtGallery' => 'ArtGallery',
	'Artery' => 'Artery',
	'Article' => 'Article',
	'AskAction' => 'AskAction',
	'AskPublicNewsArticle' => 'AskPublicNewsArticle',
	'AssessAction' => 'AssessAction',
	'AssignAction' => 'AssignAction',
	'Atlas' => 'Atlas',
	'Attorney' => 'Attorney',
	'Audience' => 'Audience',
	'AudioObject' => 'AudioObject',
	'AudioObjectSnapshot' => 'AudioObjectSnapshot',
	'Audiobook' => 'Audiobook',
	'AuthorizeAction' => 'AuthorizeAction',
	'AutoBodyShop' => 'AutoBodyShop',
	'AutoDealer' => 'AutoDealer',
	'AutoPartsStore' => 'AutoPartsStore',
	'AutoRental' => 'AutoRental',
	'AutoRepair' => 'AutoRepair',
	'AutoWash' => 'AutoWash',
	'AutomatedTeller' => 'AutomatedTeller',
	'AutomotiveBusiness' => 'AutomotiveBusiness',
	'BackgroundNewsArticle' => 'BackgroundNewsArticle',
	'Bakery' => 'Bakery',
	'BankAccount' => 'BankAccount',
	'BankOrCreditUnion' => 'BankOrCreditUnion',
	'BarOrPub' => 'BarOrPub',
	'Barcode' => 'Barcode',
	'Beach' => 'Beach',
	'BeautySalon' => 'BeautySalon',
	'BedAndBreakfast' => 'BedAndBreakfast',
	'BedDetails' => 'BedDetails',
	'BedType' => 'BedType',
	'BefriendAction' => 'BefriendAction',
	'BikeStore' => 'BikeStore',
	'BioChemEntity' => 'BioChemEntity',
	'Blog' => 'Blog',
	'BlogPosting' => 'BlogPosting',
	'BloodTest' => 'BloodTest',
	'BoardingPolicyType' => 'BoardingPolicyType',
	'BoatReservation' => 'BoatReservation',
	'BoatTerminal' => 'BoatTerminal',
	'BoatTrip' => 'BoatTrip',
	'BodyMeasurementTypeEnumeration' => 'BodyMeasurementTypeEnumeration',
	'BodyOfWater' => 'BodyOfWater',
	'Bone' => 'Bone',
	'Book' => 'Book',
	'BookFormatType' => 'BookFormatType',
	'BookSeries' => 'BookSeries',
	'BookStore' => 'BookStore',
	'BookmarkAction' => 'BookmarkAction',
	'BorrowAction' => 'BorrowAction',
	'BowlingAlley' => 'BowlingAlley',
	'BrainStructure' => 'BrainStructure',
	'Brand' => 'Brand',
	'BreadcrumbList' => 'BreadcrumbList',
	'Brewery' => 'Brewery',
	'Bridge' => 'Bridge',
	'BroadcastChannel' => 'BroadcastChannel',
	'BroadcastEvent' => 'BroadcastEvent',
	'BroadcastFrequencySpecification' => 'BroadcastFrequencySpecification',
	'BroadcastService' => 'BroadcastService',
	'BrokerageAccount' => 'BrokerageAccount',
	'BuddhistTemple' => 'BuddhistTemple',
	'BusOrCoach' => 'BusOrCoach',
	'BusReservation' => 'BusReservation',
	'BusStation' => 'BusStation',
	'BusStop' => 'BusStop',
	'BusTrip' => 'BusTrip',
	'BusinessAudience' => 'BusinessAudience',
	'BusinessEntityType' => 'BusinessEntityType',
	'BusinessEvent' => 'BusinessEvent',
	'BusinessFunction' => 'BusinessFunction',
	'BuyAction' => 'BuyAction',
	'CDCPMDRecord' => 'CDCPMDRecord',
	'CableOrSatelliteService' => 'CableOrSatelliteService',
	'CafeOrCoffeeShop' => 'CafeOrCoffeeShop',
	'Campground' => 'Campground',
	'CampingPitch' => 'CampingPitch',
	'Canal' => 'Canal',
	'CancelAction' => 'CancelAction',
	'Car' => 'Car',
	'CarUsageType' => 'CarUsageType',
	'Casino' => 'Casino',
	'CategoryCode' => 'CategoryCode',
	'CategoryCodeSet' => 'CategoryCodeSet',
	'CatholicChurch' => 'CatholicChurch',
	'Cemetery' => 'Cemetery',
	'Chapter' => 'Chapter',
	'CheckAction' => 'CheckAction',
	'CheckInAction' => 'CheckInAction',
	'CheckOutAction' => 'CheckOutAction',
	'CheckoutPage' => 'CheckoutPage',
	'ChemicalSubstance' => 'ChemicalSubstance',
	'ChildCare' => 'ChildCare',
	'ChildrensEvent' => 'ChildrensEvent',
	'ChooseAction' => 'ChooseAction',
	'Church' => 'Church',
	'City' => 'City',
	'CityHall' => 'CityHall',
	'CivicStructure' => 'CivicStructure',
	'Claim' => 'Claim',
	'ClaimReview' => 'ClaimReview',
	'Class' => 'Class',
	'Clip' => 'Clip',
	'ClothingStore' => 'ClothingStore',
	'Code' => 'Code',
	'Collection' => 'Collection',
	'CollectionPage' => 'CollectionPage',
	'CollegeOrUniversity' => 'CollegeOrUniversity',
	'ComedyClub' => 'ComedyClub',
	'ComedyEvent' => 'ComedyEvent',
	'ComicCoverArt' => 'ComicCoverArt',
	'ComicIssue' => 'ComicIssue',
	'ComicSeries' => 'ComicSeries',
	'ComicStory' => 'ComicStory',
	'Comment' => 'Comment',
	'CommentAction' => 'CommentAction',
	'CommunicateAction' => 'CommunicateAction',
	'CompleteDataFeed' => 'CompleteDataFeed',
	'CompoundPriceSpecification' => 'CompoundPriceSpecification',
	'ComputerLanguage' => 'ComputerLanguage',
	'ComputerStore' => 'ComputerStore',
	'ConfirmAction' => 'ConfirmAction',
	'Consortium' => 'Consortium',
	'ConsumeAction' => 'ConsumeAction',
	'ContactPage' => 'ContactPage',
	'ContactPoint' => 'ContactPoint',
	'ContactPointOption' => 'ContactPointOption',
	'Continent' => 'Continent',
	'ControlAction' => 'ControlAction',
	'ConvenienceStore' => 'ConvenienceStore',
	'Conversation' => 'Conversation',
	'CookAction' => 'CookAction',
	'Corporation' => 'Corporation',
	'CorrectionComment' => 'CorrectionComment',
	'Country' => 'Country',
	'Course' => 'Course',
	'CourseInstance' => 'CourseInstance',
	'Courthouse' => 'Courthouse',
	'CoverArt' => 'CoverArt',
	'CovidTestingFacility' => 'CovidTestingFacility',
	'CreateAction' => 'CreateAction',
	'CreativeWork' => 'CreativeWork',
	'CreativeWorkSeason' => 'CreativeWorkSeason',
	'CreativeWorkSeries' => 'CreativeWorkSeries',
	'CreditCard' => 'CreditCard',
	'Crematorium' => 'Crematorium',
	'CriticReview' => 'CriticReview',
	'CurrencyConversionService' => 'CurrencyConversionService',
	'DDxElement' => 'DDxElement',
	'DanceEvent' => 'DanceEvent',
	'DanceGroup' => 'DanceGroup',
	'DataCatalog' => 'DataCatalog',
	'DataDownload' => 'DataDownload',
	'DataFeed' => 'DataFeed',
	'DataFeedItem' => 'DataFeedItem',
	'Dataset' => 'Dataset',
	'DatedMoneySpecification' => 'DatedMoneySpecification',
	'DayOfWeek' => 'DayOfWeek',
	'DaySpa' => 'DaySpa',
	'DeactivateAction' => 'DeactivateAction',
	'DefenceEstablishment' => 'DefenceEstablishment',
	'DefinedRegion' => 'DefinedRegion',
	'DefinedTerm' => 'DefinedTerm',
	'DefinedTermSet' => 'DefinedTermSet',
	'DeleteAction' => 'DeleteAction',
	'DeliveryChargeSpecification' => 'DeliveryChargeSpecification',
	'DeliveryEvent' => 'DeliveryEvent',
	'DeliveryMethod' => 'DeliveryMethod',
	'DeliveryTimeSettings' => 'DeliveryTimeSettings',
	'Demand' => 'Demand',
	'Dentist' => 'Dentist',
	'DepartAction' => 'DepartAction',
	'DepartmentStore' => 'DepartmentStore',
	'DepositAccount' => 'DepositAccount',
	'DiagnosticLab' => 'DiagnosticLab',
	'DiagnosticProcedure' => 'DiagnosticProcedure',
	'Diet' => 'Diet',
	'DietarySupplement' => 'DietarySupplement',
	'DigitalDocument' => 'DigitalDocument',
	'DigitalDocumentPermission' => 'DigitalDocumentPermission',
	'DigitalDocumentPermissionType' => 'DigitalDocumentPermissionType',
	'DisagreeAction' => 'DisagreeAction',
	'DiscoverAction' => 'DiscoverAction',
	'DiscussionForumPosting' => 'DiscussionForumPosting',
	'DislikeAction' => 'DislikeAction',
	'Distance' => 'Distance',
	'Distillery' => 'Distillery',
	'DonateAction' => 'DonateAction',
	'DoseSchedule' => 'DoseSchedule',
	'DownloadAction' => 'DownloadAction',
	'DrawAction' => 'DrawAction',
	'Drawing' => 'Drawing',
	'DrinkAction' => 'DrinkAction',
	'DriveWheelConfigurationValue' => 'DriveWheelConfigurationValue',
	'Drug' => 'Drug',
	'DrugClass' => 'DrugClass',
	'DrugCost' => 'DrugCost',
	'DrugCostCategory' => 'DrugCostCategory',
	'DrugLegalStatus' => 'DrugLegalStatus',
	'DrugPregnancyCategory' => 'DrugPregnancyCategory',
	'DrugPrescriptionStatus' => 'DrugPrescriptionStatus',
	'DrugStrength' => 'DrugStrength',
	'DryCleaningOrLaundry' => 'DryCleaningOrLaundry',
	'Duration' => 'Duration',
	'EUEnergyEfficiencyEnumeration' => 'EUEnergyEfficiencyEnumeration',
	'EatAction' => 'EatAction',
	'EducationEvent' => 'EducationEvent',
	'EducationalAudience' => 'EducationalAudience',
	'EducationalOccupationalCredential' => 'EducationalOccupationalCredential',
	'EducationalOccupationalProgram' => 'EducationalOccupationalProgram',
	'EducationalOrganization' => 'EducationalOrganization',
	'Electrician' => 'Electrician',
	'ElectronicsStore' => 'ElectronicsStore',
	'ElementarySchool' => 'ElementarySchool',
	'EmailMessage' => 'EmailMessage',
	'Embassy' => 'Embassy',
	'EmergencyService' => 'EmergencyService',
	'EmployeeRole' => 'EmployeeRole',
	'EmployerAggregateRating' => 'EmployerAggregateRating',
	'EmployerReview' => 'EmployerReview',
	'EmploymentAgency' => 'EmploymentAgency',
	'EndorseAction' => 'EndorseAction',
	'EndorsementRating' => 'EndorsementRating',
	'Energy' => 'Energy',
	'EnergyConsumptionDetails' => 'EnergyConsumptionDetails',
	'EnergyEfficiencyEnumeration' => 'EnergyEfficiencyEnumeration',
	'EnergyStarEnergyEfficiencyEnumeration' => 'EnergyStarEnergyEfficiencyEnumeration',
	'EngineSpecification' => 'EngineSpecification',
	'EntertainmentBusiness' => 'EntertainmentBusiness',
	'EntryPoint' => 'EntryPoint',
	'Enumeration' => 'Enumeration',
	'Episode' => 'Episode',
	'Event' => 'Event',
	'EventAttendanceModeEnumeration' => 'EventAttendanceModeEnumeration',
	'EventReservation' => 'EventReservation',
	'EventSeries' => 'EventSeries',
	'EventStatusType' => 'EventStatusType',
	'EventVenue' => 'EventVenue',
	'ExchangeRateSpecification' => 'ExchangeRateSpecification',
	'ExerciseAction' => 'ExerciseAction',
	'ExerciseGym' => 'ExerciseGym',
	'ExercisePlan' => 'ExercisePlan',
	'ExhibitionEvent' => 'ExhibitionEvent',
	'FAQPage' => 'FAQPage',
	'FMRadioChannel' => 'FMRadioChannel',
	'FastFoodRestaurant' => 'FastFoodRestaurant',
	'Festival' => 'Festival',
	'FilmAction' => 'FilmAction',
	'FinancialProduct' => 'FinancialProduct',
	'FinancialService' => 'FinancialService',
	'FindAction' => 'FindAction',
	'FireStation' => 'FireStation',
	'Flight' => 'Flight',
	'FlightReservation' => 'FlightReservation',
	'FloorPlan' => 'FloorPlan',
	'Florist' => 'Florist',
	'FollowAction' => 'FollowAction',
	'FoodEstablishment' => 'FoodEstablishment',
	'FoodEstablishmentReservation' => 'FoodEstablishmentReservation',
	'FoodEvent' => 'FoodEvent',
	'FoodService' => 'FoodService',
	'FundingAgency' => 'FundingAgency',
	'FundingScheme' => 'FundingScheme',
	'FurnitureStore' => 'FurnitureStore',
	'Game' => 'Game',
	'GamePlayMode' => 'GamePlayMode',
	'GameServer' => 'GameServer',
	'GameServerStatus' => 'GameServerStatus',
	'GardenStore' => 'GardenStore',
	'GasStation' => 'GasStation',
	'GatedResidenceCommunity' => 'GatedResidenceCommunity',
	'GenderType' => 'GenderType',
	'Gene' => 'Gene',
	'GeneralContractor' => 'GeneralContractor',
	'GeoCircle' => 'GeoCircle',
	'GeoCoordinates' => 'GeoCoordinates',
	'GeoShape' => 'GeoShape',
	'GeospatialGeometry' => 'GeospatialGeometry',
	'GiveAction' => 'GiveAction',
	'GolfCourse' => 'GolfCourse',
	'GovernmentBenefitsType' => 'GovernmentBenefitsType',
	'GovernmentBuilding' => 'GovernmentBuilding',
	'GovernmentOffice' => 'GovernmentOffice',
	'GovernmentOrganization' => 'GovernmentOrganization',
	'GovernmentPermit' => 'GovernmentPermit',
	'GovernmentService' => 'GovernmentService',
	'Grant' => 'Grant',
	'GroceryStore' => 'GroceryStore',
	'Guide' => 'Guide',
	'HVACBusiness' => 'HVACBusiness',
	'Hackathon' => 'Hackathon',
	'HairSalon' => 'HairSalon',
	'HardwareStore' => 'HardwareStore',
	'HealthAndBeautyBusiness' => 'HealthAndBeautyBusiness',
	'HealthAspectEnumeration' => 'HealthAspectEnumeration',
	'HealthClub' => 'HealthClub',
	'HealthInsurancePlan' => 'HealthInsurancePlan',
	'HealthPlanCostSharingSpecification' => 'HealthPlanCostSharingSpecification',
	'HealthPlanFormulary' => 'HealthPlanFormulary',
	'HealthPlanNetwork' => 'HealthPlanNetwork',
	'HealthTopicContent' => 'HealthTopicContent',
	'HighSchool' => 'HighSchool',
	'HinduTemple' => 'HinduTemple',
	'HobbyShop' => 'HobbyShop',
	'HomeAndConstructionBusiness' => 'HomeAndConstructionBusiness',
	'HomeGoodsStore' => 'HomeGoodsStore',
	'Hospital' => 'Hospital',
	'Hostel' => 'Hostel',
	'Hotel' => 'Hotel',
	'HotelRoom' => 'HotelRoom',
	'House' => 'House',
	'HousePainter' => 'HousePainter',
	'HowTo' => 'HowTo',
	'HowToDirection' => 'HowToDirection',
	'HowToItem' => 'HowToItem',
	'HowToSection' => 'HowToSection',
	'HowToStep' => 'HowToStep',
	'HowToSupply' => 'HowToSupply',
	'HowToTip' => 'HowToTip',
	'HowToTool' => 'HowToTool',
	'HyperToc' => 'HyperToc',
	'HyperTocEntry' => 'HyperTocEntry',
	'IceCreamShop' => 'IceCreamShop',
	'IgnoreAction' => 'IgnoreAction',
	'ImageGallery' => 'ImageGallery',
	'ImageObject' => 'ImageObject',
	'ImageObjectSnapshot' => 'ImageObjectSnapshot',
	'ImagingTest' => 'ImagingTest',
	'IndividualProduct' => 'IndividualProduct',
	'InfectiousAgentClass' => 'InfectiousAgentClass',
	'InfectiousDisease' => 'InfectiousDisease',
	'InformAction' => 'InformAction',
	'InsertAction' => 'InsertAction',
	'InstallAction' => 'InstallAction',
	'InsuranceAgency' => 'InsuranceAgency',
	'Intangible' => 'Intangible',
	'InteractAction' => 'InteractAction',
	'InteractionCounter' => 'InteractionCounter',
	'InternetCafe' => 'InternetCafe',
	'InvestmentFund' => 'InvestmentFund',
	'InvestmentOrDeposit' => 'InvestmentOrDeposit',
	'InviteAction' => 'InviteAction',
	'Invoice' => 'Invoice',
	'ItemAvailability' => 'ItemAvailability',
	'ItemList' => 'ItemList',
	'ItemListOrderType' => 'ItemListOrderType',
	'ItemPage' => 'ItemPage',
	'JewelryStore' => 'JewelryStore',
	'JobPosting' => 'JobPosting',
	'JoinAction' => 'JoinAction',
	'Joint' => 'Joint',
	'LakeBodyOfWater' => 'LakeBodyOfWater',
	'Landform' => 'Landform',
	'LandmarksOrHistoricalBuildings' => 'LandmarksOrHistoricalBuildings',
	'Language' => 'Language',
	'LearningResource' => 'LearningResource',
	'LeaveAction' => 'LeaveAction',
	'LegalForceStatus' => 'LegalForceStatus',
	'LegalService' => 'LegalService',
	'LegalValueLevel' => 'LegalValueLevel',
	'Legislation' => 'Legislation',
	'LegislationObject' => 'LegislationObject',
	'LegislativeBuilding' => 'LegislativeBuilding',
	'LendAction' => 'LendAction',
	'Library' => 'Library',
	'LibrarySystem' => 'LibrarySystem',
	'LifestyleModification' => 'LifestyleModification',
	'Ligament' => 'Ligament',
	'LikeAction' => 'LikeAction',
	'LinkRole' => 'LinkRole',
	'LiquorStore' => 'LiquorStore',
	'ListItem' => 'ListItem',
	'ListenAction' => 'ListenAction',
	'LiteraryEvent' => 'LiteraryEvent',
	'LiveBlogPosting' => 'LiveBlogPosting',
	'LoanOrCredit' => 'LoanOrCredit',
	'LocalBusiness' => 'LocalBusiness',
	'LocationFeatureSpecification' => 'LocationFeatureSpecification',
	'Locksmith' => 'Locksmith',
	'LodgingBusiness' => 'LodgingBusiness',
	'LodgingReservation' => 'LodgingReservation',
	'LoseAction' => 'LoseAction',
	'LymphaticVessel' => 'LymphaticVessel',
	'Manuscript' => 'Manuscript',
	'Map' => 'Map',
	'MapCategoryType' => 'MapCategoryType',
	'MarryAction' => 'MarryAction',
	'Mass' => 'Mass',
	'MathSolver' => 'MathSolver',
	'MaximumDoseSchedule' => 'MaximumDoseSchedule',
	'MeasurementTypeEnumeration' => 'MeasurementTypeEnumeration',
	'MediaGallery' => 'MediaGallery',
	'MediaManipulationRatingEnumeration' => 'MediaManipulationRatingEnumeration',
	'MediaObject' => 'MediaObject',
	'MediaReview' => 'MediaReview',
	'MediaReviewItem' => 'MediaReviewItem',
	'MediaSubscription' => 'MediaSubscription',
	'MedicalAudience' => 'MedicalAudience',
	'MedicalAudienceType' => 'MedicalAudienceType',
	'MedicalBusiness' => 'MedicalBusiness',
	'MedicalCause' => 'MedicalCause',
	'MedicalClinic' => 'MedicalClinic',
	'MedicalCode' => 'MedicalCode',
	'MedicalCondition' => 'MedicalCondition',
	'MedicalConditionStage' => 'MedicalConditionStage',
	'MedicalContraindication' => 'MedicalContraindication',
	'MedicalDevice' => 'MedicalDevice',
	'MedicalDevicePurpose' => 'MedicalDevicePurpose',
	'MedicalEntity' => 'MedicalEntity',
	'MedicalEnumeration' => 'MedicalEnumeration',
	'MedicalEvidenceLevel' => 'MedicalEvidenceLevel',
	'MedicalGuideline' => 'MedicalGuideline',
	'MedicalGuidelineContraindication' => 'MedicalGuidelineContraindication',
	'MedicalGuidelineRecommendation' => 'MedicalGuidelineRecommendation',
	'MedicalImagingTechnique' => 'MedicalImagingTechnique',
	'MedicalIndication' => 'MedicalIndication',
	'MedicalIntangible' => 'MedicalIntangible',
	'MedicalObservationalStudy' => 'MedicalObservationalStudy',
	'MedicalObservationalStudyDesign' => 'MedicalObservationalStudyDesign',
	'MedicalOrganization' => 'MedicalOrganization',
	'MedicalProcedure' => 'MedicalProcedure',
	'MedicalProcedureType' => 'MedicalProcedureType',
	'MedicalRiskCalculator' => 'MedicalRiskCalculator',
	'MedicalRiskEstimator' => 'MedicalRiskEstimator',
	'MedicalRiskFactor' => 'MedicalRiskFactor',
	'MedicalRiskScore' => 'MedicalRiskScore',
	'MedicalScholarlyArticle' => 'MedicalScholarlyArticle',
	'MedicalSign' => 'MedicalSign',
	'MedicalSignOrSymptom' => 'MedicalSignOrSymptom',
	'MedicalSpecialty' => 'MedicalSpecialty',
	'MedicalStudy' => 'MedicalStudy',
	'MedicalStudyStatus' => 'MedicalStudyStatus',
	'MedicalSymptom' => 'MedicalSymptom',
	'MedicalTest' => 'MedicalTest',
	'MedicalTestPanel' => 'MedicalTestPanel',
	'MedicalTherapy' => 'MedicalTherapy',
	'MedicalTrial' => 'MedicalTrial',
	'MedicalTrialDesign' => 'MedicalTrialDesign',
	'MedicalWebPage' => 'MedicalWebPage',
	'MedicineSystem' => 'MedicineSystem',
	'MeetingRoom' => 'MeetingRoom',
	'MensClothingStore' => 'MensClothingStore',
	'Menu' => 'Menu',
	'MenuItem' => 'MenuItem',
	'MenuSection' => 'MenuSection',
	'MerchantReturnEnumeration' => 'MerchantReturnEnumeration',
	'MerchantReturnPolicy' => 'MerchantReturnPolicy',
	'MerchantReturnPolicySeasonalOverride' => 'MerchantReturnPolicySeasonalOverride',
	'Message' => 'Message',
	'MiddleSchool' => 'MiddleSchool',
	'MobileApplication' => 'MobileApplication',
	'MobilePhoneStore' => 'MobilePhoneStore',
	'MolecularEntity' => 'MolecularEntity',
	'MonetaryAmount' => 'MonetaryAmount',
	'MonetaryAmountDistribution' => 'MonetaryAmountDistribution',
	'MonetaryGrant' => 'MonetaryGrant',
	'MoneyTransfer' => 'MoneyTransfer',
	'MortgageLoan' => 'MortgageLoan',
	'Mosque' => 'Mosque',
	'Motel' => 'Motel',
	'Motorcycle' => 'Motorcycle',
	'MotorcycleDealer' => 'MotorcycleDealer',
	'MotorcycleRepair' => 'MotorcycleRepair',
	'MotorizedBicycle' => 'MotorizedBicycle',
	'Mountain' => 'Mountain',
	'MoveAction' => 'MoveAction',
	'Movie' => 'Movie',
	'MovieClip' => 'MovieClip',
	'MovieRentalStore' => 'MovieRentalStore',
	'MovieSeries' => 'MovieSeries',
	'MovieTheater' => 'MovieTheater',
	'MovingCompany' => 'MovingCompany',
	'Muscle' => 'Muscle',
	'Museum' => 'Museum',
	'MusicAlbum' => 'MusicAlbum',
	'MusicAlbumProductionType' => 'MusicAlbumProductionType',
	'MusicAlbumReleaseType' => 'MusicAlbumReleaseType',
	'MusicComposition' => 'MusicComposition',
	'MusicEvent' => 'MusicEvent',
	'MusicGroup' => 'MusicGroup',
	'MusicPlaylist' => 'MusicPlaylist',
	'MusicRecording' => 'MusicRecording',
	'MusicRelease' => 'MusicRelease',
	'MusicReleaseFormatType' => 'MusicReleaseFormatType',
	'MusicStore' => 'MusicStore',
	'MusicVenue' => 'MusicVenue',
	'MusicVideoObject' => 'MusicVideoObject',
	'NGO' => 'NGO',
	'NLNonprofitType' => 'NLNonprofitType',
	'NailSalon' => 'NailSalon',
	'Nerve' => 'Nerve',
	'NewsArticle' => 'NewsArticle',
	'NewsMediaOrganization' => 'NewsMediaOrganization',
	'Newspaper' => 'Newspaper',
	'NightClub' => 'NightClub',
	'NonprofitType' => 'NonprofitType',
	'Notary' => 'Notary',
	'NoteDigitalDocument' => 'NoteDigitalDocument',
	'NutritionInformation' => 'NutritionInformation',
	'Observation' => 'Observation',
	'Occupation' => 'Occupation',
	'OccupationalExperienceRequirements' => 'OccupationalExperienceRequirements',
	'OccupationalTherapy' => 'OccupationalTherapy',
	'OceanBodyOfWater' => 'OceanBodyOfWater',
	'Offer' => 'Offer',
	'OfferCatalog' => 'OfferCatalog',
	'OfferForLease' => 'OfferForLease',
	'OfferForPurchase' => 'OfferForPurchase',
	'OfferItemCondition' => 'OfferItemCondition',
	'OfferShippingDetails' => 'OfferShippingDetails',
	'OfficeEquipmentStore' => 'OfficeEquipmentStore',
	'OnDemandEvent' => 'OnDemandEvent',
	'OpeningHoursSpecification' => 'OpeningHoursSpecification',
	'OpinionNewsArticle' => 'OpinionNewsArticle',
	'Optician' => 'Optician',
	'Order' => 'Order',
	'OrderAction' => 'OrderAction',
	'OrderItem' => 'OrderItem',
	'OrderStatus' => 'OrderStatus',
	'Organization' => 'Organization',
	'OrganizationRole' => 'OrganizationRole',
	'OrganizeAction' => 'OrganizeAction',
	'OutletStore' => 'OutletStore',
	'OwnershipInfo' => 'OwnershipInfo',
	'PaintAction' => 'PaintAction',
	'Painting' => 'Painting',
	'PalliativeProcedure' => 'PalliativeProcedure',
	'ParcelDelivery' => 'ParcelDelivery',
	'ParentAudience' => 'ParentAudience',
	'Park' => 'Park',
	'ParkingFacility' => 'ParkingFacility',
	'PathologyTest' => 'PathologyTest',
	'Patient' => 'Patient',
	'PawnShop' => 'PawnShop',
	'PayAction' => 'PayAction',
	'PaymentCard' => 'PaymentCard',
	'PaymentChargeSpecification' => 'PaymentChargeSpecification',
	'PaymentMethod' => 'PaymentMethod',
	'PaymentService' => 'PaymentService',
	'PaymentStatusType' => 'PaymentStatusType',
	'PeopleAudience' => 'PeopleAudience',
	'PerformAction' => 'PerformAction',
	'PerformanceRole' => 'PerformanceRole',
	'PerformingArtsTheater' => 'PerformingArtsTheater',
	'PerformingGroup' => 'PerformingGroup',
	'Periodical' => 'Periodical',
	'Permit' => 'Permit',
	'Person' => 'Person',
	'PetStore' => 'PetStore',
	'Pharmacy' => 'Pharmacy',
	'Photograph' => 'Photograph',
	'PhotographAction' => 'PhotographAction',
	'PhysicalActivity' => 'PhysicalActivity',
	'PhysicalActivityCategory' => 'PhysicalActivityCategory',
	'PhysicalExam' => 'PhysicalExam',
	'PhysicalTherapy' => 'PhysicalTherapy',
	'Physician' => 'Physician',
	'Place' => 'Place',
	'PlaceOfWorship' => 'PlaceOfWorship',
	'PlanAction' => 'PlanAction',
	'Play' => 'Play',
	'PlayAction' => 'PlayAction',
	'Playground' => 'Playground',
	'Plumber' => 'Plumber',
	'PodcastEpisode' => 'PodcastEpisode',
	'PodcastSeason' => 'PodcastSeason',
	'PodcastSeries' => 'PodcastSeries',
	'PoliceStation' => 'PoliceStation',
	'Pond' => 'Pond',
	'PostOffice' => 'PostOffice',
	'PostalAddress' => 'PostalAddress',
	'PostalCodeRangeSpecification' => 'PostalCodeRangeSpecification',
	'Poster' => 'Poster',
	'PreOrderAction' => 'PreOrderAction',
	'PrependAction' => 'PrependAction',
	'Preschool' => 'Preschool',
	'PresentationDigitalDocument' => 'PresentationDigitalDocument',
	'PreventionIndication' => 'PreventionIndication',
	'PriceComponentTypeEnumeration' => 'PriceComponentTypeEnumeration',
	'PriceSpecification' => 'PriceSpecification',
	'PriceTypeEnumeration' => 'PriceTypeEnumeration',
	'Product' => 'Product',
	'ProductCollection' => 'ProductCollection',
	'ProductGroup' => 'ProductGroup',
	'ProductModel' => 'ProductModel',
	'ProductReturnEnumeration' => 'ProductReturnEnumeration',
	'ProductReturnPolicy' => 'ProductReturnPolicy',
	'ProfessionalService' => 'ProfessionalService',
	'ProfilePage' => 'ProfilePage',
	'ProgramMembership' => 'ProgramMembership',
	'Project' => 'Project',
	'PronounceableText' => 'PronounceableText',
	'Property' => 'Property',
	'PropertyValue' => 'PropertyValue',
	'PropertyValueSpecification' => 'PropertyValueSpecification',
	'Protein' => 'Protein',
	'PsychologicalTreatment' => 'PsychologicalTreatment',
	'PublicSwimmingPool' => 'PublicSwimmingPool',
	'PublicToilet' => 'PublicToilet',
	'PublicationEvent' => 'PublicationEvent',
	'PublicationIssue' => 'PublicationIssue',
	'PublicationVolume' => 'PublicationVolume',
	'QAPage' => 'QAPage',
	'QualitativeValue' => 'QualitativeValue',
	'QuantitativeValue' => 'QuantitativeValue',
	'QuantitativeValueDistribution' => 'QuantitativeValueDistribution',
	'Quantity' => 'Quantity',
	'Question' => 'Question',
	'Quiz' => 'Quiz',
	'Quotation' => 'Quotation',
	'QuoteAction' => 'QuoteAction',
	'RVPark' => 'RVPark',
	'RadiationTherapy' => 'RadiationTherapy',
	'RadioBroadcastService' => 'RadioBroadcastService',
	'RadioChannel' => 'RadioChannel',
	'RadioClip' => 'RadioClip',
	'RadioEpisode' => 'RadioEpisode',
	'RadioSeason' => 'RadioSeason',
	'RadioSeries' => 'RadioSeries',
	'RadioStation' => 'RadioStation',
	'Rating' => 'Rating',
	'ReactAction' => 'ReactAction',
	'ReadAction' => 'ReadAction',
	'RealEstateAgent' => 'RealEstateAgent',
	'RealEstateListing' => 'RealEstateListing',
	'ReceiveAction' => 'ReceiveAction',
	'Recipe' => 'Recipe',
	'Recommendation' => 'Recommendation',
	'RecommendedDoseSchedule' => 'RecommendedDoseSchedule',
	'RecyclingCenter' => 'RecyclingCenter',
	'RefundTypeEnumeration' => 'RefundTypeEnumeration',
	'RegisterAction' => 'RegisterAction',
	'RejectAction' => 'RejectAction',
	'RentAction' => 'RentAction',
	'RentalCarReservation' => 'RentalCarReservation',
	'RepaymentSpecification' => 'RepaymentSpecification',
	'ReplaceAction' => 'ReplaceAction',
	'ReplyAction' => 'ReplyAction',
	'Report' => 'Report',
	'ReportageNewsArticle' => 'ReportageNewsArticle',
	'ReportedDoseSchedule' => 'ReportedDoseSchedule',
	'ResearchOrganization' => 'ResearchOrganization',
	'ResearchProject' => 'ResearchProject',
	'Researcher' => 'Researcher',
	'Reservation' => 'Reservation',
	'ReservationPackage' => 'ReservationPackage',
	'ReservationStatusType' => 'ReservationStatusType',
	'ReserveAction' => 'ReserveAction',
	'Reservoir' => 'Reservoir',
	'Residence' => 'Residence',
	'Resort' => 'Resort',
	'Restaurant' => 'Restaurant',
	'RestrictedDiet' => 'RestrictedDiet',
	'ResumeAction' => 'ResumeAction',
	'ReturnAction' => 'ReturnAction',
	'ReturnFeesEnumeration' => 'ReturnFeesEnumeration',
	'ReturnLabelSourceEnumeration' => 'ReturnLabelSourceEnumeration',
	'ReturnMethodEnumeration' => 'ReturnMethodEnumeration',
	'Review' => 'Review',
	'ReviewAction' => 'ReviewAction',
	'ReviewNewsArticle' => 'ReviewNewsArticle',
	'RiverBodyOfWater' => 'RiverBodyOfWater',
	'Role' => 'Role',
	'RoofingContractor' => 'RoofingContractor',
	'Room' => 'Room',
	'RsvpAction' => 'RsvpAction',
	'RsvpResponseType' => 'RsvpResponseType',
	'SaleEvent' => 'SaleEvent',
	'SatiricalArticle' => 'SatiricalArticle',
	'Schedule' => 'Schedule',
	'ScheduleAction' => 'ScheduleAction',
	'ScholarlyArticle' => 'ScholarlyArticle',
	'School' => 'School',
	'SchoolDistrict' => 'SchoolDistrict',
	'ScreeningEvent' => 'ScreeningEvent',
	'Sculpture' => 'Sculpture',
	'SeaBodyOfWater' => 'SeaBodyOfWater',
	'SearchAction' => 'SearchAction',
	'SearchResultsPage' => 'SearchResultsPage',
	'Season' => 'Season',
	'Seat' => 'Seat',
	'SeekToAction' => 'SeekToAction',
	'SelfStorage' => 'SelfStorage',
	'SellAction' => 'SellAction',
	'SendAction' => 'SendAction',
	'Series' => 'Series',
	'Service' => 'Service',
	'ServiceChannel' => 'ServiceChannel',
	'ShareAction' => 'ShareAction',
	'SheetMusic' => 'SheetMusic',
	'ShippingDeliveryTime' => 'ShippingDeliveryTime',
	'ShippingRateSettings' => 'ShippingRateSettings',
	'ShoeStore' => 'ShoeStore',
	'ShoppingCenter' => 'ShoppingCenter',
	'ShortStory' => 'ShortStory',
	'SingleFamilyResidence' => 'SingleFamilyResidence',
	'SiteNavigationElement' => 'SiteNavigationElement',
	'SizeGroupEnumeration' => 'SizeGroupEnumeration',
	'SizeSpecification' => 'SizeSpecification',
	'SizeSystemEnumeration' => 'SizeSystemEnumeration',
	'SkiResort' => 'SkiResort',
	'SocialEvent' => 'SocialEvent',
	'SocialMediaPosting' => 'SocialMediaPosting',
	'SoftwareApplication' => 'SoftwareApplication',
	'SoftwareSourceCode' => 'SoftwareSourceCode',
	'SolveMathAction' => 'SolveMathAction',
	'SomeProducts' => 'SomeProducts',
	'SpeakableSpecification' => 'SpeakableSpecification',
	'SpecialAnnouncement' => 'SpecialAnnouncement',
	'Specialty' => 'Specialty',
	'SportingGoodsStore' => 'SportingGoodsStore',
	'SportsActivityLocation' => 'SportsActivityLocation',
	'SportsClub' => 'SportsClub',
	'SportsEvent' => 'SportsEvent',
	'SportsOrganization' => 'SportsOrganization',
	'SportsTeam' => 'SportsTeam',
	'SpreadsheetDigitalDocument' => 'SpreadsheetDigitalDocument',
	'StadiumOrArena' => 'StadiumOrArena',
	'State' => 'State',
	'Statement' => 'Statement',
	'StatisticalPopulation' => 'StatisticalPopulation',
	'StatusEnumeration' => 'StatusEnumeration',
	'SteeringPositionValue' => 'SteeringPositionValue',
	'Store' => 'Store',
	'StructuredValue' => 'StructuredValue',
	'StupidType' => 'StupidType',
	'SubscribeAction' => 'SubscribeAction',
	'Substance' => 'Substance',
	'SubwayStation' => 'SubwayStation',
	'Suite' => 'Suite',
	'SuperficialAnatomy' => 'SuperficialAnatomy',
	'SurgicalProcedure' => 'SurgicalProcedure',
	'SuspendAction' => 'SuspendAction',
	'Synagogue' => 'Synagogue',
	'TVClip' => 'TVClip',
	'TVEpisode' => 'TVEpisode',
	'TVSeason' => 'TVSeason',
	'TVSeries' => 'TVSeries',
	'Table' => 'Table',
	'TakeAction' => 'TakeAction',
	'TattooParlor' => 'TattooParlor',
	'Taxi' => 'Taxi',
	'TaxiReservation' => 'TaxiReservation',
	'TaxiService' => 'TaxiService',
	'TaxiStand' => 'TaxiStand',
	'Taxon' => 'Taxon',
	'TechArticle' => 'TechArticle',
	'TelevisionChannel' => 'TelevisionChannel',
	'TelevisionStation' => 'TelevisionStation',
	'TennisComplex' => 'TennisComplex',
	'TextDigitalDocument' => 'TextDigitalDocument',
	'TheaterEvent' => 'TheaterEvent',
	'TheaterGroup' => 'TheaterGroup',
	'TherapeuticProcedure' => 'TherapeuticProcedure',
	'Thesis' => 'Thesis',
	'Thing' => 'Thing',
	'Ticket' => 'Ticket',
	'TieAction' => 'TieAction',
	'TipAction' => 'TipAction',
	'TireShop' => 'TireShop',
	'TouristAttraction' => 'TouristAttraction',
	'TouristDestination' => 'TouristDestination',
	'TouristInformationCenter' => 'TouristInformationCenter',
	'TouristTrip' => 'TouristTrip',
	'ToyStore' => 'ToyStore',
	'TrackAction' => 'TrackAction',
	'TradeAction' => 'TradeAction',
	'TrainReservation' => 'TrainReservation',
	'TrainStation' => 'TrainStation',
	'TrainTrip' => 'TrainTrip',
	'TransferAction' => 'TransferAction',
	'TravelAction' => 'TravelAction',
	'TravelAgency' => 'TravelAgency',
	'TreatmentIndication' => 'TreatmentIndication',
	'Trip' => 'Trip',
	'TypeAndQuantityNode' => 'TypeAndQuantityNode',
	'UKNonprofitType' => 'UKNonprofitType',
	'USNonprofitType' => 'USNonprofitType',
	'UnRegisterAction' => 'UnRegisterAction',
	'UnitPriceSpecification' => 'UnitPriceSpecification',
	'UpdateAction' => 'UpdateAction',
	'UseAction' => 'UseAction',
	'UserBlocks' => 'UserBlocks',
	'UserCheckins' => 'UserCheckins',
	'UserComments' => 'UserComments',
	'UserDownloads' => 'UserDownloads',
	'UserInteraction' => 'UserInteraction',
	'UserLikes' => 'UserLikes',
	'UserPageVisits' => 'UserPageVisits',
	'UserPlays' => 'UserPlays',
	'UserPlusOnes' => 'UserPlusOnes',
	'UserReview' => 'UserReview',
	'UserTweets' => 'UserTweets',
	'Vehicle' => 'Vehicle',
	'Vein' => 'Vein',
	'Vessel' => 'Vessel',
	'VeterinaryCare' => 'VeterinaryCare',
	'VideoGallery' => 'VideoGallery',
	'VideoGame' => 'VideoGame',
	'VideoGameClip' => 'VideoGameClip',
	'VideoGameSeries' => 'VideoGameSeries',
	'VideoObject' => 'VideoObject',
	'VideoObjectSnapshot' => 'VideoObjectSnapshot',
	'ViewAction' => 'ViewAction',
	'VirtualLocation' => 'VirtualLocation',
	'VisualArtsEvent' => 'VisualArtsEvent',
	'VisualArtwork' => 'VisualArtwork',
	'VitalSign' => 'VitalSign',
	'Volcano' => 'Volcano',
	'VoteAction' => 'VoteAction',
	'WPAdBlock' => 'WPAdBlock',
	'WPFooter' => 'WPFooter',
	'WPHeader' => 'WPHeader',
	'WPSideBar' => 'WPSideBar',
	'WantAction' => 'WantAction',
	'WarrantyPromise' => 'WarrantyPromise',
	'WarrantyScope' => 'WarrantyScope',
	'WatchAction' => 'WatchAction',
	'Waterfall' => 'Waterfall',
	'WearAction' => 'WearAction',
	'WearableMeasurementTypeEnumeration' => 'WearableMeasurementTypeEnumeration',
	'WearableSizeGroupEnumeration' => 'WearableSizeGroupEnumeration',
	'WearableSizeSystemEnumeration' => 'WearableSizeSystemEnumeration',
	'WebAPI' => 'WebAPI',
	'WebApplication' => 'WebApplication',
	'WebContent' => 'WebContent',
	'WebPage' => 'WebPage',
	'WebPageElement' => 'WebPageElement',
	'WebSite' => 'WebSite',
	'WholesaleStore' => 'WholesaleStore',
	'WinAction' => 'WinAction',
	'Winery' => 'Winery',
	'WorkBasedProgram' => 'WorkBasedProgram',
	'WorkersUnion' => 'WorkersUnion',
	'WriteAction' => 'WriteAction',
	'Zoo' => 'Zoo',
];
