<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8"/>
    <xsl:template match="/goods">
        <table border="1">
            <tr><th>Item Number</th><th>Item Name</th><th>Price</th><th>Quantity Available</th><th>Quantity on Hold</th><th>Quantity Sold</th></tr>
            <xsl:for-each select="item[sold &gt; 0]">
                <tr>
                    <td><xsl:value-of select="number"/></td>
                    <td><xsl:value-of select="name"/></td>
                    <td>$<xsl:value-of select="price"/></td>
                    <td><xsl:value-of select="available"/></td>
                    <td><xsl:value-of select="hold"/></td>
                    <td><xsl:value-of select="sold"/></td>
                </tr>
            </xsl:for-each>
            <tr class="actions"><td colspan="6" align="center"><input type="button" value="Process" onclick="processItems()"/></td></tr>
        </table>
    </xsl:template>
</xsl:stylesheet>
