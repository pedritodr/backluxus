<?php
/**
 * Copyright (c) 2013, Esendex Ltd.
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of Esendex nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Testing
 * @package    Esendex
 * @author     Esendex Support <support@esendex.com>
 * @copyright  2013 Esendex Ltd.
 * @license    http://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause
 * @link       https://github.com/esendex/esendex-php-sdk
 */
namespace Esendex;

class GetStandardReportWithInvalidDateRangeTypeTest extends \PHPUnit_Framework_TestCase
{
    private $startDate;
    private $endDate;

    private $authentication;
    private $service;
    private $httpUtil;
    private $surveyId;

    function setUp()
    {
        $this->startDate = new \DateTime("2016-12-01T00:00:00");
        $this->endDate = new \DateTime("2016-12-02T00:00:00");

        $this->authentication = new Authentication\LoginAuthentication("SV0000001", "someone@esendex.com", "hunter2");
        $this->surveyId = "e6ea4f5e-4d41-4b1e-8912-6c3131978a77";

        $this->httpUtil = $this->getMock("\\Esendex\\Http\\IHttp");
        $this->service = new SurveyReportService($this->authentication, $this->httpUtil);
    }

    /**
     * @test
     */
    function getStandardReport()
    {
        try {
            $this->service->getStandardReport($this->surveyId, null, null, 999);
        }
        catch (\Exception $e)
        {
            $this->assertEquals("Invalid date range type", $e->getMessage());
            return;
        }

        $this->fail("Expected getStandardReport to throw an exception");
    }
}
