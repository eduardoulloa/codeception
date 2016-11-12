<?php

/**
 * Class GenealogyModelTest
 *
 * Performs Unit Testing of the genealogy component. Unit tests include tests for all of the
 * model methods.
 */
class GenealogyModelTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;

   /**
    * @var \CodeGuy
    */
    protected $codeGuy;
    protected $distributors;
    protected $distributorPlacements;

    protected function _before()
    {
        // NOTE: when I tried to initialize the mock objects at creation time they did not init correctly.
        // Therefore I took the approach of first creating the mock object, then populating it.
        $this->distributors['rep1'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1000;
        $this->distributors['rep2'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1001;
        $this->distributors['rep3'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1002;
        $this->distributors['rep4'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1003;
        $this->distributors['rep5'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1004;
        $this->distributors['rep6'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1005;
        $this->distributors['rep7'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1006;
        $this->distributors['rep8'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1007;
        $this->distributors['rep9'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1008;
        $this->distributors['rep10'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1009;
        $this->distributors['rep11'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1010;
        $this->distributors['rep12'] = Mockery::mock('Distributor["id"]');
        $this->distributors['rep1']->id = 1011;

        $this->distributorPlacements['placement1'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement1']->id = 1;
        $this->distributorPlacements['placement1']->distributorId = 1011;
        $this->distributorPlacements['placement1']->enrollerDistributorId = 1008;
        $this->distributorPlacements['placement1']->sponsorDistributorId = 1004;
        $this->distributorPlacements['placement2'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement2']->distributorId = 1010;
        $this->distributorPlacements['placement2']->enrollerDistributorId = 1008;
        $this->distributorPlacements['placement2']->sponsorDistributorId = 1009;
        $this->distributorPlacements['placement3'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement3']->distributorId = 1009;
        $this->distributorPlacements['placement3']->enrollerDistributorId = 1008;
        $this->distributorPlacements['placement3']->sponsorDistributorId = 1007;
        $this->distributorPlacements['placement4'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement4']->distributorId = 1008;
        $this->distributorPlacements['placement4']->enrollerDistributorId = 1004;
        $this->distributorPlacements['placement4']->sponsorDistributorId = 1003;
        $this->distributorPlacements['placement5'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement5']->distributorId = 1007;
        $this->distributorPlacements['placement5']->enrollerDistributorId = 1005;
        $this->distributorPlacements['placement5']->sponsorDistributorId = 1003;
        $this->distributorPlacements['placement5'] = Mockery::mock('DistributorPlacement["id","distributorId","enrollerDistributorId","sponsorDistributorId"]');
        $this->distributorPlacements['placement5']->distributorId = 1007;
        $this->distributorPlacements['placement5']->enrollerDistributorId = 1005;
        $this->distributorPlacements['placement5']->sponsorDistributorId = 1003;

    }

    protected function _after()
    {
    }

    // tests
    public function testGenealogyModel()
    {



        // Model tests
        $this->specify("distributor returns the correct Distributor record", function()
        {
            $record = $this->distributorPlacements['placement1'];
            $this->assertEquals(1011, $record->distributor->id);
        });
        $this->specify("enroller returns the correct Distributor record", function()
        {
            $record = $this->distributorPlacements['placement1'];
            $this->assertEquals(1008, $record->enroller->id);
        });
        $this->specify("sponsor return the correct Distributor record", function()
        {
            $record = $this->distributorPlacements['placement1'];
            $this->assertEquals(1004, $record->sponsor->id);
        });
        $this->specify("repInDownline succeeds when rep is in downline", function()
        {
            //$this->assertTrue($this->distributorPlacements['placement5']->repInDownline($this->distributors['rep11']));
            $this->distributorPlacements['placement5']->shouldReceive('repInDownline')->once()->andReturn(1);
        });
        $this->specify("repInDownline fails when rep is not in downline", function()
        {
            $this->assertFalse($this->distributorPlacements['placement2']->repInDownline($this->distributors['rep11']));
        });
        $this->specify("getDownline returns an object containing a rep downline", function()
        {
            $downline = $this->distributorPlacements['placement5']->getDownline(['levelCount' => 3]);
            $downline->assertInstanceOf('DistributorPlacement','DistributorPlacement');
        });
        $this->specify("getUpline returns an object containing a rep upline", function()
        {
            $upline = $this->distributorPlacements['placement5']->getUpline(['levelCount' => 3]);
            $upline->assertInstanceOf('DistributorPlacement','DistributorPlacement');
        });
        $this->specify("checkCycle returns true when the specified tree has no closed cycles", function()
        {

        });
        $this->specify("checkCycle returns false when the specified tree has a closed cycle", function()
        {

        });
        $this->specify("buildTree populates an entire tree structure", function()
        {

        });
        $this->specify("traverseTree is able to traverse two levels of the specified tree", function()
        {

        });
        $this->specify("traverseTree is able to traverse five levels of the specified tree", function()
        {

        });
        $this->specify("traverseTree is able to traverse all levels of the specified tree", function()
        {

        });
        $this->specify("insertSponsor adds a rep to the placement tree under a specified sponsor", function()
        {

        });
        $this->specify("moveSponsor moves a rep within the placement tree under an older specified sponsor", function()
        {

        });
        $this->specify("moveSponsor fails to move a rep within the placement tree under a younger sponsor", function()
        {

        });
        $this->specify("insertEnroller adds a rep to the enroller tree under a specified enroller", function()
        {

        });
        $this->specify("moveEnroller moves a rep within the enroller tree under a specified sponsor", function()
        {

        });
        $this->specify("getCodedLinks returns an object containing all six coded link values", function()
        {

        });
        $this->specify("saveCodedLinks properly stores coded link values for a specified rep", function()
        {

        });
        $this->specify("setCodedLinks updates coded link values for a specified rep", function()
        {

        });
    }

}