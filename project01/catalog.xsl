<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8"/>
    <xsl:template match="/goods">
        <table border="1">
            <tr><th>Item Number</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Add</th></tr>
            <xsl:for-each select="item[available &gt; 0]">
                <tr>
                    <td><xsl:value-of select="number"/></td>
                    <td><xsl:value-of select="name"/></td>
                    <td><xsl:value-of select="substring(description, 1, 20)"/></td>
                    <td>$<xsl:value-of select="price"/></td>
                    <td><xsl:value-of select="available"/></td>
                    <td><input type="button" value="Add one to the cart" onclick="addToCart({number})"/></td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
