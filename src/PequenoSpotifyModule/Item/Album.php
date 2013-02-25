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
namespace PequenoSpotifyModule\Item;

class Album extends AbstractItem
{

    /** @var string */
    protected $_released = null;

    /** @var Artist[] */
    protected $_artists = null;

    /** @var ExternalId[] */
    protected $_externalIds = null;

    /**
     * Initialize datas
     * @access protected
     * @return AbstractItem
     */
    protected function initialize()
    {
        // call parent method
        parent::initialize();

        // initialize specific datas
        $this->_released    = '';
        $this->_artists     = array();
        $this->_externalIds = array();
    }

    /**
     * Set artist participate to album
     * @access public
     * @param  Artist[] $artists Artist participate to album
     * @return Album
     */
    public function setArtists($artists)
    {
        // store artists and return self
        $this->_artists = (array) $artists;

        return $this;
    }

    /**
     * Get artist participate to album
     * @access public
     * @return Artist[]
     */
    public function getArtists()
    {
        // return artists
        return (array) $this->_artists;
    }

    /**
     * Set album ExternalId
     * @access public
     * @param  ExternalId[] $externalIds album ExternalId
     * @return Album
     */
    public function setExternalIds($externalIds)
    {
        // store ExternalIds and return self
        $this->_externalIds = (array) $externalIds;

        return $this;
    }

    /**
     * Set album ExternalId
     * @access public
     * @return ExternalId[]
     */
    public function getExternalIds()
    {
        // return ExternalIds
        return (array) $this->_externalIds;
    }

    /**
     * Set album released date
     * @access public
     * @param  string $released Album released date
     * @return Album
     */
    public function setReleased($released)
    {
        // store released date and return self
        $this->_released = (string) $released;

        return $this;
    }

    /**
     * Get album released date
     * @access public
     * @return string
     */
    public function getReleased()
    {
        // return album released date
        return (string) $this->_released;
    }

    /**
     * Extract Album informations from object
     * @access public
     * @static
     * @param  \stdClass $album Object represent Album
     * @return Album
     */
    public static function extractInfos($album)
    {
        // create Album instance
        $albumItem = new self();

        // update informations
        $albumItem->setUri((string) $album->href);
        $albumItem->setName((string) $album->name);

        // is popularity available ?
        if (isset($album->popularity)) {

            // update popularity
            $albumItem->setPopularity((float) $album->popularity);
        }

        // is released date available ?
        if (isset($album->released)) {

            // update released dates
            $albumItem->setReleased((string) $album->released);
        }

        // is artists available ?
        if (isset($album->artists) && is_array($album->artists)) {

            // setup artists container
            $artists = array();

            // iterate artists
            foreach ($album->artists as $artist) {

                // create Artist and store on container
                $artists[] = Artist::extractInfos($artist);
            }

            // set artists of album
            $albumItem->setArtists($artists);
        }

        // is external ids available ?
        if (isset($album->{'external-ids'}) && is_array($album->{'external-ids'})) {

            // setup external ids container
            $externalIds = array();

            // iterate external ids
            foreach ($album->{'external-ids'} as $externalId) {

                // create ExternalId and store on container
                $externalIds[] = ExternalId::extractInfos($externalId);
            }

            // set external ids of album
            $albumItem->setExternalIds($externalIds);
        }

        // return album instance
        return $albumItem;
    }

}
