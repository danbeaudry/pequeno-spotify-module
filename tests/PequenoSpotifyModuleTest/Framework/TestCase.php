<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

// set class namespace
namespace PequenoSpotifyModuleTest\Framework;

// set used namespaces
use PHPUnit_Framework_TestCase,
    Zend\Di\LocatorInterface;

class TestCase extends PHPUnit_Framework_TestCase
{

    /** @var \Zend\Di\LocatorInterface */
    protected static $locator;

    /**
     * Set Zend\Di\LocatorInterface locator instance
     * @access public
     * @static
     * @param  LocatorInterface $locator
     * @return void
     */
    public static function setLocator($locator)
    {
        // store LocatorInterface instance
        self::$locator = $locator;
    }

    /**
     * Get Zend\Di\LocatorInterface locator instance
     * @access public
     * @return LocatorInterface
     */
    public function getLocator()
    {
        // return LocatorInterface instance
        return self::$locator;
    }
}