<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Snmportal\External\Dompdf\FrameDecorator;

require_once __DIR__ . "/AbstractFrameDecorator.php";
use Snmportal\External\Dompdf\Dompdf;
use Snmportal\External\Dompdf\Frame;
use Snmportal\External\Dompdf\FrameDecorator\Table as TableFrameDecorator;

/**
 * Decorates Frames for table row layout
 *
 * @package dompdf
 */
class TableRow extends AbstractFrameDecorator
{
    function __construct(Frame $frame, Dompdf $dompdf)
    {
        parent::__construct($frame, $dompdf);
    }

    //........................................................................

    /**
     * Remove all non table-cell frames from this row and move them after
     * the table.
     */
    function normalise()
    {

        // Find our table parent
        $p = TableFrameDecorator::find_parent_table($this);

        $erroneous_frames = array();
        foreach ($this->get_children() as $child) {
            $display = $child->get_style()->display;

            if ($display !== "table-cell") {
                $erroneous_frames[] = $child;
            }
        }

        //  dump the extra nodes after the table.
        foreach ($erroneous_frames as $frame) {
            $p->move_after($frame);
        }
    }


}
